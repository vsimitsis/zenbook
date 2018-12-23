<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompanyFieldsAtUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('company_id')->unsigned()->after('email');
            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('company_role_id')->unsigned()->after('company_id');
            $table->foreign('company_role_id')
                ->references('id')
                ->on('company_roles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_company_id_foreign');
            $table->dropColumn('company_id');
            $table->dropForeign('users_company_role_id_foreign');
            $table->dropColumn('company_role_id');
        });
    }
}
