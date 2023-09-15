<?php

namespace App\Traits\Database;

use Illuminate\Database\Schema\Blueprint;

trait Migration
{
    public function addForeignKey(Blueprint $table, string $columnName, string $tableName, bool $nullable = true): void
    {
        if ($nullable) {
            $table->unsignedBigInteger($columnName)->index()->nullable();
            $table->foreign($columnName)->references('id')->on($tableName)->onDelete('set null');
        } else {
            $table->unsignedBigInteger($columnName)->index();
            $table->foreign($columnName)->references('id')->on($tableName)->onDelete('CASCADE');
        }
    }

    public function addSeoFields(Blueprint $table): void
    {
        $table->string('seo_title', 60)->nullable();
        $table->string('seo_description', 160)->nullable();
    }
}
