<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreatePublicSetorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(
            '
                SET default_with_oids = true;
                
                CREATE TABLE public.setor (
                    idset integer DEFAULT nextval(\'public.setor_idset_seq\'::regclass) NOT NULL,
                    nivel numeric(1,0) NOT NULL,
                    nome character varying(100) NOT NULL,
                    sigla character varying(25),
                    idsetsub integer,
                    idsetredir integer,
                    situacao character(1) NOT NULL,
                    localizacao character(1) NOT NULL,
                    CONSTRAINT ck_setor_localizacao CHECK (((localizacao = \'E\'::bpchar) OR (localizacao = \'I\'::bpchar))),
                    CONSTRAINT ck_setor_situacao CHECK (((situacao = \'A\'::bpchar) OR (situacao = \'I\'::bpchar)))
                );
            '
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('public.setor');
    }
}
