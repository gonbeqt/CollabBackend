<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'mongodb';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection($this->connection)->create('personal_access_tokens', function ($collection) {
            $collection->index('tokenable_type');
            $collection->index('tokenable_id');
            $collection->index(['tokenable_type', 'tokenable_id']);
            $collection->index('token', null, ['unique' => true]);
            $collection->index('last_used_at');
            $collection->index('expires_at');
            $collection->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('personal_access_tokens');
    }
};