<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Disable foreign key check for this connection before running seeders
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $sql = "SELECT table_name FROM information_schema.tables WHERE table_schema = :dbname";
        $tables = \DB::select($sql, ['dbname' => \DB::connection()->getDatabaseName()]);
        $tables = array_column($tables, 'table_name');

        foreach ($tables as $table) {
            if (in_array($table, ['migrations'])) {
                continue;
            }

            Db::table($table)->truncate();
        }

        $this->call([
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
        ]);

        // Enable foreign key check for this connection after running seeders
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Model::reguard();
    }
}
