<?php

namespace App\Http\Controllers;

use App\Document;
use App\Http\Requests\DocumentRequest;
use Aws\S3\Exception\S3Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('documents.index', [
            'documents' => $this->fetchDocuments($request),
            'search'    => $request->search,
            'access'    => $request->access,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('documents.create', [
            'document' => new Document()
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param DocumentRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(DocumentRequest $request)
    {
        try {
            $path = $request->file('document')->store(Document::buildS3Path(Auth::user()->company, Auth::user()), 's3');
        } catch (S3Exception $exception) {
            return redirect()
                ->back()
                ->with('error', 'There was a problem uploading the file. Error code: "' . $exception->getAwsErrorCode() . '". Please try again later.');
        }

        $document = $this->createDocument($request, $path);

        $this->assignAccesses($request, $document);

        return redirect(route('document.index'))
            ->with('success', 'The document have been uploaded successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        return redirect(url(Storage::disk('s3')->temporaryUrl($document->storage_path, now()->addMinutes(10))));
    }

    /**
     * Download the file directly from storage
     *
     * @param Document $document
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function download(Document $document)
    {
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $document->original_filename . '"',
        ];

        return response(Storage::disk('s3')->get($document->storage_path), 200, $headers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Document $document
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Document $document)
    {
        $this->authorize('edit', $document);

        return view('documents.edit', [
            'document' => $document,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DocumentRequest $request
     * @param Document $document
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(DocumentRequest $request, Document $document)
    {
        $this->authorize('edit', $document);

        $document->original_filename = $this->renameIfExists($request, $document);
        $document->access            = $request->access;
        $document->save();

        $this->assignAccesses($request, $document);

        return redirect(route('document.index'))
            ->with('success', __('messages.changes_saved'));
    }

    /**
     * Delete the document from storage and db record
     *
     * @param Document $document
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Document $document)
    {
        $this->authorize('edit', $document);

        if (Storage::disk('s3')->delete($document->storage_path)) {
            $document->accessedUsers()->detach();
            $document->delete();

            return redirect(route('document.index'))
                ->with('success', __('messages.document_deleted'));
        }

        return redirect(route('document.index'))
            ->with('error', __('messages.document_not_deleted'));
    }

    /**
     * Fetch company's documents and filter them
     *
     * @param Request $request
     * @return mixed
     */
    protected function fetchDocuments(Request $request)
    {
        $documentQuery = Document::where('company_id', Auth::user()->company_id);

        if ($request->search) {
            $documentQuery = $documentQuery->where('original_filename', 'LIKE', '%' . $request->search . '%');
        }

        switch ($request->access) {
            case 'public':
                $documentQuery = $documentQuery->where('access', Document::PUBLIC_ACCESS);
                break;
            case 'private':
                $documentQuery = $documentQuery->where('access', Document::PRIVATE_ACCESS);
                break;
            case 'shared':
                $documentQuery = $documentQuery->where('access', Document::SHARED_ACCESS);
                break;
            default:
                break;
        }

        return $documentQuery->paginate(10);
    }

    /**
     * Stores a newly created document in database and returns the model
     *
     * @param DocumentRequest $request
     * @param string $path
     * @return Document
     */
    protected function createDocument(DocumentRequest $request, string $path) :Document
    {
        $file     = $request->file('document');
        $fileName = $this->renameIfExists($request);

        return Document::create([
            'company_id'        => Auth::user()->company_id,
            'user_id'           => Auth::user()->id,
            'original_filename' => $fileName,
            'storage_path'      => $path,
            'mime_type'         => $file->getMimeType(),
            'access'            => $request->access,
        ]);
    }

    /**
     * Attach all document user accesses
     *
     * @param DocumentRequest $request
     * @param Document $document
     * @return bool
     */
    protected function assignAccesses(DocumentRequest $request, Document $document)
    {
        if ($request->access != Document::SHARED_ACCESS || !isset($request->user_access)) {
            if ($document->accessedUsers) {
                $document->accessedUsers()->detach();
            }
            return false;
        }

        $accessedUserIDs = collect($request->user_access);

        $document->accessedUsers()->detach();

        if (!empty($accessedUserIDs)) {
            $document->accessedUsers()->attach($accessedUserIDs);
        }

        return true;
    }

    /**
     * Check if a document with this filename exists and rename it
     *
     * @param DocumentRequest $request
     * @param Document $document
     * @return string
     */
    protected function renameIfExists(DocumentRequest $request, Document $document = null) :string
    {
        $fileName   = $request->name ?: $request->file('document')->getClientOriginalName();
        $countQuery = Auth::user()->company->documents()->where('original_filename', $fileName);

        if ($document) {
            $countQuery = $countQuery->where('id', '!=', $document->id);
        }

        $count = $countQuery->count();

        if ($count) {
            $fileName .= "_$count";
        }

        return $fileName;
    }
}
