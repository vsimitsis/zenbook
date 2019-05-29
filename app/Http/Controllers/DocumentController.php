<?php

namespace App\Http\Controllers;

use App\Document;
use App\Http\Requests\DocumentRequest;
use App\TeacherDocument;
use Aws\S3\Exception\S3Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'status'    => $request->status,
            'role'      => $request->role,
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
    {dd($request->all());
        $user     = Auth::user();
        $file     = $request->file('document');
        $fileName = $this->renameIfExists($request);

        try {
            $path = $file->store(Document::buildS3Path($user->company, $user), 's3');
        } catch (S3Exception $exception) {
            return redirect()
                ->back()
                ->with('error', 'There was a problem uploading the file. Error code: "' . $exception->getAwsErrorCode() . '". Please try again later.');
        }

        Document::create([
            'company_id'        => $user->company_id,
            'user_id'           => $user->id,
            'original_filename' => $fileName,
            'storage_path'      => $path,
            'mime_type'         => $file->getMimeType(),
            'access'            => $request->access,
        ]);

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //
    }

    /**
     * Fetch company's documents and filter them
     *
     * @param Request $request
     * @return mixed
     */
    protected function fetchDocuments(Request $request)
    {
        $documents = Document::where('company_id', Auth::user()->company_id)->paginate(10);

        return $documents;
    }

    /**
     * Check if a document with this filename exists and rename it
     *
     * @param DocumentRequest $request
     * @return string
     */
    protected function renameIfExists(DocumentRequest $request) :string
    {
        $fileName  = $request->name ?: $request->file('document')->getFilename();
        $count     = Auth::user()->company->documents()->where('original_filename', $fileName)->count();

        if ($count) {
            return $fileName . ' (' . $count . ')';
        }

        return $fileName;
    }
}
