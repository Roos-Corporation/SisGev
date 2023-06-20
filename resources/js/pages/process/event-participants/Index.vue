<template>
    <div class="page-content">
        <div class="row">

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            <i class="link-icon" data-feather="users"></i> Listagem de participantes

                        </h6>

                        <button type="button" class="btn btn-primary" @click="$router.push('/event-participants/form')">
                            ➕ Cadastrar participante
                        </button>

                    </div>
                </div>
            </div>

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTableList" class="table" >
                                <thead>
                                    <tr>
                                        <th>Evento</th>
                                        <th>Qtd. Etapas</th>
                                        <th>Nome</th>
                                        <th>Sobrenome</th>
                                        <th>Contabilidade</th>
                                        <th># Ticket</th>
                                        <th>Status</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(eventParticipant,i) in eventParticipants" :key="i">

                                        <td>{{ eventParticipant.event_name }}</td>
                                        <td>{{ eventParticipant.event_stages }}</td>
                                        <td>{{ eventParticipant.person_first_name }}</td>
                                        <td>{{ eventParticipant.person_last_name }}</td>
                                        <td>{{ eventParticipant.person_accounting }}</td>
                                        <td class="text-uppercase">{{ eventParticipant.ticket_number }}</td>

                                        <td >
                                            {{
                                                eventParticipant.status == 'a' ? 'confirmado' :
                                                eventParticipant.status == 'c' ? 'Cancelado' :
                                                eventParticipant.status == 'r' ? 'Reservado' : ''
                                            }}
                                        </td>
                                        <td>

                                            <button type="button" class="btn btn-primary btn-xs ml-4" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" @click="handleEditEventParticipants(eventParticipant)">
                                                ✏️
                                            </button>
                                            ᠎
                                            <button type="button" class="btn btn-danger btn-xs  mx-auto" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir" @click="handleDeleteEventParticipants(eventParticipant)">
                                                🗑️
                                            </button>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  import { onMounted, ref } from 'vue'
  import { useRouter } from 'vue-router'
  import { convertToDatable } from '../../../components/datable.js'

  export default {
    name: 'IndexEventParticipants',
    data() {
        const router = useRouter();

        let eventParticipants = ref([]);

        const getEventParticipants = async () => {
            let response = await axios.get("api/event-participants");

            eventParticipants.value = response.data.data

            //Set table to an datable
            convertToDatable('dataTableList')
        }

        const handleEditEventParticipants = async (eventParticipant) => {

            router.push({ path: '/event-participants/form', query: { id: eventParticipant.id } })
        }

        const handleDeleteEventParticipants = async (eventParticipant) => {

            Swal.fire({
                title: 'Tem certeza ?',
                text: "Você não pode voltar atrás.",
                icon:"warning",
                showCancelButton:true,
                confirmButtonText:"Sim, excluir"

            }).then((result)=>{
                if(result.value){
                    axios.delete(`/api/event-participants/${eventParticipant.id}`, {
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then((response)=>{
                        getEventParticipants();
                        Swal.fire(
                            'Excluído',
                            'Participante excluída neste evento com sucesso',
                            'success'
                        );
                    }).catch((error)=>{

                        Swal.fire(
                            'Falhou',
                            error.message,
                            'error'
                        );
                    });
                }
            })
        }


        onMounted(async () => {
            Swal.fire({
                title: 'Por favor aguarde!',
                text: "Carregando...",
                icon:"warning",
                showCancelButton:false,
                showConfirmButton:false,
                time: 3000,
                timeProgressBar:true,

            })
            await getEventParticipants();
            Swal.close();
        })

      return {
        eventParticipants,
        handleEditEventParticipants,
        handleDeleteEventParticipants,
      }
    },


  }
</script>
