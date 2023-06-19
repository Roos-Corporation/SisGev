<template>
    <div class="page-content">
        <div class="row">

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            <i class="link-icon" data-feather="users"></i> Listagem de eventos

                        </h6>

                        <button type="button" class="btn btn-primary" @click="$router.push('/events/form')">
                            ➕ Cadastrar evento
                        </button>

                    </div>
                </div>
            </div>

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Nome</th>
                                        <th>Responsável</th>
                                        <th>Etapas</th>
                                        <th>Capacidade</th>
                                        <th>Localização</th>
                                        <th>Status</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(event,i) in events" :key="i">

                                        <td>{{ event.id }}</td>
                                        <td>{{ event.name }}</td>
                                        <td>{{ event.responsible }}</td>
                                        <td>{{ event.stages }}</td>
                                        <td>{{ event.capacity }}</td>
                                        <td>{{ event.location }}</td>
                                        <td>

                                            {{
                                                event.status == 'a' ? 'Ativo' :
                                                event.status == 'c' ? 'Cancelado' :
                                                event.status == 'r' ? 'Reportado' :
                                                event.status == 'f' ? 'Finalizado' : ''

                                            }}
                                        </td>
                                        <td>

                                            <button type="button" class="btn btn-primary btn-xs ml-4" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" @click="handleEditEvents(event)">
                                                ✏️
                                            </button>
                                            ᠎
                                            <button type="button" class="btn btn-danger btn-xs  mx-auto" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir" @click="handleDeleteEvents(event)">
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
  export default {
    name: 'IndexEvents',
    data() {
        const router = useRouter();

        let events = ref([]);

        const getEvents = async () => {
            let response = await axios.get("api/events");

            events.value = response.data.data
        }

        const handleEditEvents = async (event) => {

            router.push({ path: '/events/form', query: { id: event.id } })
        }

        const handleDeleteEvents = async (event) => {
            Swal.fire({
                title: 'Tem certeza ?',
                text: "Você não pode voltar atrás.",
                icon:"warning",
                showCancelButton:true,
                confirmButtonText:"Sim, excluir"

            }).then((result)=>{
                if(result.value){
                    axios.delete(`/api/events/${event.id}`, {
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then((response)=>{
                        getEvents();
                        Swal.fire(
                            'Excluído',
                            'Evento excluído com sucesso',
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
            getEvents();
        })

      return {
        events,
        handleEditEvents,
        handleDeleteEvents,
      }
    },


  }
</script>
