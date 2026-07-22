<?php

namespace Tests\Feature;

use App\Models\Proyecto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProyectoApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba listar todos los proyectos.
     */
    public function test_can_list_projects(): void
    {
        $proyecto1 = Proyecto::create([
            'nombre' => 'Laptop HP',
            'fecha_inicio' => '2026-07-19',
            'estado' => 'Activo',
            'responsable' => 'Juan Perez',
            'monto' => 1200.50
        ]);

        $proyecto2 = Proyecto::create([
            'nombre' => 'Monitor Dell',
            'fecha_inicio' => '2026-07-20',
            'estado' => 'Inactivo',
            'responsable' => 'Maria Lopez',
            'monto' => 350.00
        ]);

        $response = $this->getJson('/api/proyecto');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'message',
                     'data' => [
                         '*' => [
                             'id',
                             'nombre',
                             'fecha_inicio',
                             'estado',
                             'responsable',
                             'monto',
                             'created_at',
                             'updated_at'
                         ]
                     ]
                 ])
                 ->assertJsonCount(2, 'data');
     }

    /**
     * Prueba obtener un solo proyecto.
     */
    public function test_can_show_single_project(): void
    {
        $proyecto = Proyecto::create([
            'nombre' => 'Laptop HP',
            'fecha_inicio' => '2026-07-19',
            'estado' => 'Activo',
            'responsable' => 'Juan Perez',
            'monto' => 1200.50
        ]);

        $response = $this->getJson('/api/proyecto/' . $proyecto->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Proyecto obtenido correctamente',
                     'data' => [
                         'id' => $proyecto->id,
                         'nombre' => 'Laptop HP',
                         'fecha_inicio' => '2026-07-19',
                         'estado' => 'Activo',
                         'responsable' => 'Juan Perez',
                         'monto' => '1200.50'
                     ]
                 ]);
     }

    /**
     * Prueba que consultar un proyecto inexistente devuelva 404.
     */
    public function test_show_non_existing_project_returns_404(): void
    {
        $response = $this->getJson('/api/proyecto/999');

        $response->assertStatus(404);
     }

    /**
     * Prueba crear un nuevo proyecto.
     */
    public function test_can_create_project(): void
    {
        $data = [
            'nombre' => 'Teclado Mecanico',
            'fecha_inicio' => '2026-07-21',
            'estado' => 'Activo',
            'responsable' => 'Carlos Gomez',
            'monto' => 89.99
        ];

        $response = $this->postJson('/api/proyecto', $data);

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'Proyecto creado exitosamente',
                     'data' => [
                         'nombre' => 'Teclado Mecanico',
                         'fecha_inicio' => '2026-07-21',
                         'estado' => 'Activo',
                         'responsable' => 'Carlos Gomez',
                         'monto' => 89.99
                     ]
                 ]);

        $this->assertDatabaseHas('proyectos', [
            'nombre' => 'Teclado Mecanico',
            'responsable' => 'Carlos Gomez',
            'monto' => 89.99
        ]);
     }

    /**
     * Prueba las validaciones al crear un proyecto.
     */
    public function test_create_project_validation(): void
    {
        $response = $this->postJson('/api/proyecto', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors([
                     'nombre',
                     'fecha_inicio',
                     'estado',
                     'responsable',
                     'monto'
                 ]);
     }

    /**
     * Prueba actualizar un proyecto existente.
     */
    public function test_can_update_project(): void
    {
        $proyecto = Proyecto::create([
            'nombre' => 'Laptop HP',
            'fecha_inicio' => '2026-07-19',
            'estado' => 'Activo',
            'responsable' => 'Juan Perez',
            'monto' => 1200.50
        ]);

        $data = [
            'nombre' => 'Laptop HP Pro',
            'monto' => 1350.00
        ];

        $response = $this->putJson('/api/proyecto/' . $proyecto->id, $data);

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Proyecto actualizado exitosamente',
                     'data' => [
                         'id' => $proyecto->id,
                         'nombre' => 'Laptop HP Pro',
                         'monto' => 1350.00
                     ]
                 ]);

        $this->assertDatabaseHas('proyectos', [
            'id' => $proyecto->id,
            'nombre' => 'Laptop HP Pro',
            'monto' => 1350.00
        ]);
     }

    /**
     * Prueba las validaciones al actualizar un proyecto.
     */
    public function test_update_project_validation(): void
    {
        $proyecto = Proyecto::create([
            'nombre' => 'Laptop HP',
            'fecha_inicio' => '2026-07-19',
            'estado' => 'Activo',
            'responsable' => 'Juan Perez',
            'monto' => 1200.50
        ]);

        $response = $this->putJson('/api/proyecto/' . $proyecto->id, [
            'monto' => 'invalid-numeric'
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['monto']);
     }

    /**
     * Prueba eliminar un proyecto.
     */
    public function test_can_delete_project(): void
    {
        $proyecto = Proyecto::create([
            'nombre' => 'Laptop HP',
            'fecha_inicio' => '2026-07-19',
            'estado' => 'Activo',
            'responsable' => 'Juan Perez',
            'monto' => 1200.50
        ]);

        $response = $this->deleteJson('/api/proyecto/' . $proyecto->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Proyecto eliminado exitosamente'
                 ]);

        $this->assertDatabaseMissing('proyectos', [
            'id' => $proyecto->id
        ]);
     }
}
