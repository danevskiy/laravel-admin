<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            // удалить существующий FK
            $table->dropForeign('employees_company_id_foreign');

            // изменить колонку
            $table->unsignedBigInteger('company_id')->nullable()->change();

            // добавить FK обратно
            $table->foreign('company_id')
                  ->references('id')
                  ->on('companies')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign('employees_company_id_foreign');
            $table->unsignedBigInteger('company_id')->nullable(false)->change();
            $table->foreign('company_id')
                  ->references('id')
                  ->on('companies')
                  ->onDelete('cascade');
        });
    }
};
