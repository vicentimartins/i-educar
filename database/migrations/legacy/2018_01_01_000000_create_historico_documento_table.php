<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricoDocumentoTable extends Migration
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
                
                CREATE TABLE historico.documento (
                    idpes numeric(8,0) NOT NULL,
                    rg character varying(25),
                    data_exp_rg date,
                    sigla_uf_exp_rg character(2),
                    tipo_cert_civil numeric(2,0),
                    num_termo numeric(8,0),
                    num_livro character varying(8),
                    num_folha numeric(4,0),
                    data_emissao_cert_civil date,
                    sigla_uf_cert_civil character(2),
                    cartorio_cert_civil character varying(150),
                    num_cart_trabalho numeric(7,0),
                    serie_cart_trabalho numeric(5,0),
                    data_emissao_cart_trabalho date,
                    sigla_uf_cart_trabalho character(2),
                    num_tit_eleitor numeric(13,0),
                    zona_tit_eleitor numeric(4,0),
                    secao_tit_eleitor numeric(4,0),
                    idorg_exp_rg integer,
                    idpes_rev numeric,
                    idsis_rev numeric,
                    data_rev timestamp without time zone,
                    origem_gravacao character(1) NOT NULL,
                    idpes_cad numeric,
                    idsis_cad numeric NOT NULL,
                    data_cad timestamp without time zone NOT NULL,
                    operacao character(1) NOT NULL,
                    CONSTRAINT ck_documento_operacao CHECK (((operacao = \'I\'::bpchar) OR (operacao = \'A\'::bpchar) OR (operacao = \'E\'::bpchar))),
                    CONSTRAINT ck_documento_tipo_cert CHECK (((tipo_cert_civil >= (91)::numeric) AND (tipo_cert_civil <= (92)::numeric))),
                    CONSTRAINT ck_fone_pessoa_origem_gravacao CHECK (((origem_gravacao = \'M\'::bpchar) OR (origem_gravacao = \'U\'::bpchar) OR (origem_gravacao = \'C\'::bpchar) OR (origem_gravacao = \'O\'::bpchar)))
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
        Schema::dropIfExists('historico.documento');
    }
}
