<?php

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
    Schema::create('formule', function (Blueprint $table) {
        $table->id();

        // معلومات VFS
        $table->string('vfsAccount')->nullable();
        $table->string('existingVfsEmail')->nullable();
        $table->string('vfsPassword')->nullable();
        $table->string('emailPassword')->nullable();
        $table->string('newFirstName')->nullable();
        $table->string('newLastName')->nullable();
        $table->string('newEmail')->nullable();
        $table->string('newEmailPassword')->nullable();
        $table->string('newPhone')->nullable();

        // معلومات TCF
        $table->string('idNumber')->nullable();
        $table->date('idExpiry')->nullable();
        $table->string('firstName')->nullable();
        $table->string('lastName')->nullable();
        $table->date('birthDate')->nullable();
        $table->string('phone')->nullable();
        $table->string('birthCountry')->nullable();
        $table->string('nationality')->nullable();
        $table->string('gender')->nullable();
        $table->string('language')->nullable();
        $table->string('registrationReason')->nullable();

        // العنوان
        $table->string('address')->nullable();
        $table->string('commune')->nullable();
        $table->string('wilaya')->nullable();
        $table->string('postalCode')->nullable();

        // تفضيلات الامتحان
        $table->string('examCenter')->nullable();
        $table->string('otherCenter')->nullable();
        $table->date('periodFrom')->nullable();
        $table->date('periodTo')->nullable();
        $table->string('timeSlot')->nullable();
        $table->text('remarks')->nullable();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formule');
    }
};
