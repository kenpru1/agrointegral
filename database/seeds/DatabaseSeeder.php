<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->truncateMultiple([
            'cache',
            'jobs',
            'sessions',
        ]);
 
        $this->call(AuthTableSeeder::class);
        $this->call(PaisesTableSeeder::class);
        $this->call(ComunasTableSeeder::class);
        $this->call(PlanesTableSeeder::class);
        $this->call(RegionesTableSeeder::class);
        $this->call(ProvinciasTableSeeder::class);
        $this->call(UnidadesTableSeeder::class);
        $this->call(TipoTrabajadoresTableSeeder::class);
        $this->call(NivelCalificacionTableSeeder::class);
        $this->call(PrimeraEmpresaTableSeeder::class);
        $this->call(AsignacionEmpresaAdminTableSeeder::class);
        $this->call(EstadoVentaTableSeeder::class);
        $this->call(TipoOperacionesTableSeeder::class);
        $this->call(TrabajosTableSeeder::class);
        $this->call(CondicionesPagoTableSeeder::class);
        $this->call(TiposPagoTableSeeder::class);
        $this->call(FuentesTableSeeder::class);
        $this->call(EstadoPresupuestoTableSeeder::class);
        $this->call(EstadoFacturaTableSeeder::class);
        $this->call(TipoEnviosTableSeeder::class);
        $this->call(EstadoPublicacionTableSeeder::class);
        $this->call(EstadoOportunidadTableSeeder::class);
        $this->call(EtapaOportunidadTableSeeder::class);

        Model::reguard();
    }
}
