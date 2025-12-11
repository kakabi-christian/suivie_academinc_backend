<?php

use Tests\TestCase;
use App\Models\Filiere;

test('create filiere', function () {
    $filiere = Filiere::factory()->make();

    $response = $this->withHeaders([
        "Authorization" => "Bearer " . "3|3bgHD1ngVHXyF7LP7a4SbVgmT6yr7PaY73lb3kTE2181f6ca"
    ])->postJson('/api/filieres', [
        'code_filiere' => $filiere->code_filiere,
        'label_filiere' => $filiere->label_filiere,
        'desc_filiere' => $filiere->desc_filiere,
    ]);

    $response->assertStatus(201)
             ->assertJsonStructure([
                 'message',
                 'data' => [
                     'code_filiere',
                     'label_filiere',
                     'desc_filiere',
                     'created_at',
                     'updated_at',
                 ]
             ]);
});

test('update filiere', function () {
    // Crée une filière en DB
    $filiere = Filiere::factory()->create();

    $updateData = [
        'label_filiere' => 'Label mis à jour',
        'desc_filiere' => 'Description mise à jour',
    ];

    $response = $this->withHeaders([
        "Authorization" => "Bearer " . "3|3bgHD1ngVHXyF7LP7a4SbVgmT6yr7PaY73lb3kTE2181f6ca"
    ])->putJson("/api/filieres/{$filiere->code_filiere}", $updateData);

    $response->assertStatus(200)
             ->assertJsonFragment([
                 'label_filiere' => 'Label mis à jour',
                 'desc_filiere' => 'Description mise à jour',
             ]);
});

test('delete filiere', function () {
    // Crée une filière en DB
    $filiere = Filiere::factory()->create();

    $response = $this->withHeaders([
        "Authorization" => "Bearer " . "3|3bgHD1ngVHXyF7LP7a4SbVgmT6yr7PaY73lb3kTE2181f6ca"
    ])->deleteJson("/api/filieres/{$filiere->code_filiere}");

    $response->assertStatus(200)
             ->assertJson(['message' => 'Suppression réussie']);
});
