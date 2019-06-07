//const base = window.location.origin;
//const url = window.location.pathname.split('/');
//const baseUrl = `${base}/${url[1]}/${url[2]}/api.php`;



let construct = () => {
    atividades();
}

const atividades = () => {

    $('#formulario').on('submit', function (e) {
        e.preventDefault();

        let titulo = $('#titulo').val(),
            responsavel = $('#responsavel').val(),
            carga_horaria = $('#carga_horaria').val(),
            data = $('#data').val(),
            hora_inicio = $('#hora_inicio').val(),
            hora_termino = $('#hora_termino').val(),
            local = $('#local').val(),
            quantidade_vaga = $('#quantidade_vaga').val(),
            tipo = $('#tipo option:selected').val(),
            evento_id = $('#formulario').attr('data-evento_id');
            //console.log(titulo, responsavel, data, hora_inicio, hora_termino, local, quantidade_vaga, tipo);
        const validaHorario = () => {
            let hr_ini = hora_inicio.split(":")
            let hr_fim = hora_termino.split(":")

            if (hr_ini[0] < hr_fim[0]) {
                return true
            } else {
                if (hr_ini[0] == hr_fim[0] && hr_ini[1] < hr_fim[1]) {
                    return true
                } else {
                    $('#msg_alerta').toast('show');
                    return false
                }
            }
        };




        if (titulo !== "" &&
            responsavel !== "" &&
            carga_horaria != "" &&
            data !== "" &&
            hora_inicio !== "" &&
            hora_termino !== "" &&
            local !== "" &&
            quantidade_vaga !== "" &&
            tipo !== "" &&
            validaHorario()
        ) {
            let dados = {
                titulo: titulo,
                responsavel: responsavel,
                carga_horaria: carga_horaria,
                datahora_inicio: data +" "+ hora_inicio,
                datahora_termino: data +" "+ hora_termino,
                local: local,
                quantidade_vaga: quantidade_vaga,
                tipo: tipo
            };

            if (evento_id !== "") dados.evento_id = evento_id;


            dados.acao = "Atividades/cadastrar";
            //console.log(dados);


            $.ajax({
                url: baseUrl,
                type: "POST",
                data: dados,
                dataType: "text",
                async: true,
                success: function (res) {
                    if (res) {

                        $('#msg_sucesso').toast('show'); // Para aparecer a mensagem de sucesso
                        $('#formulario').each( function () {
                        this.reset(); // Pra limpar o formulário
                        });

                    } else {
                        alert('Cadastro não efetuado');
                        $('#msg_erro').toast('show');
                    }
                },
                error: function (request, status, str_error) {
                    console.log(request, status, str_error)
                }
            });
        }
    });
};

construct();
