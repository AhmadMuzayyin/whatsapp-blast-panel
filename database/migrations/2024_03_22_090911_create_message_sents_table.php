<?php

use App\Models\Phonebook;
use App\Models\WhatsappAccount;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('message_sents', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(WhatsappAccount::class)->constrained()->cascadeOnDelete();
            $table->string('phone_number');
            $table->string('message');
            $table->enum('status', ['pending', 'sent', 'failed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_sents');
    }
};
