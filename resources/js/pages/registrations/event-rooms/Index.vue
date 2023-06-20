<template>
    <div class="page-content">
        <div class="row">

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            <i class="link-icon" data-feather="users"></i> Listagem de salas de eventos

                        </h6>

                        <button type="button" class="btn btn-primary" @click="$router.push('/event-rooms/form')">
                            ➕ Cadastrar sala
                        </button>

                    </div>
                </div>
            </div>

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTableList" class="table">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Nome</th>
                                        <th>Capacidade</th>
                                        <th>Localização</th>
                                        <th>Status</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(eventRoom,i) in eventRooms" :key="i">

                                        <td>{{ eventRoom.id }}</td>
                                        <td>{{ eventRoom.name }}</td>
                                        <td>{{ eventRoom.capacity }}</td>
                                        <td>{{ eventRoom.location }}</td>
                                        <td>

                                            {{
                                                eventRoom.status == 'd' ? 'Disponível' :
                                                eventRoom.status == 'm' ? 'Em manutenção' :
                                                eventRoom.status == 'r' ? 'Reservada' : ''

                                            }}
                                        </td>
                                        <td>

                                            <button type="button" class="btn btn-primary btn-xs ml-4" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" @click="handleEditEventRooms(eventRoom)">
                                                ✏️
                                            </button>
                                            ᠎
                                            <button type="button" class="btn btn-danger btn-xs  mx-auto" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir" @click="handleDeleteEventRooms(eventRoom)">
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
import Swal from 'sweetalert2';
  export default {
    name: 'IndexEventRooms',
    data() {
        const router = useRouter();

        let eventRooms = ref([]);

        const getEventRooms = async () => {
            let response = await axios.get("api/event-rooms");

            eventRooms.value = response.data.data
            //Set table to an datable
            convertToDatable('dataTableList')
        }

        const handleEditEventRooms = async (event) => {

            router.push({ path: '/event-rooms/form', query: { id: event.id } })
        }

        const handleDeleteEventRooms = async (event) => {
            Swal.fire({
                title: 'Tem certeza ?',
                text: "Você não pode voltar atrás.",
                icon:"warning",
                showCancelButton:true,
                confirmButtonText:"Sim, excluir"

            }).then((result)=>{
                if(result.value){
                    axios.delete(`/api/event-rooms/${event.id}`, {
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then((response)=>{
                        getEventRooms();
                        Swal.fire(
                            'Excluído',
                            'Sala de envento excluída com sucesso',
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
            await getEventRooms();
            Swal.close()
        })

      return {
        eventRooms,
        handleEditEventRooms,
        handleDeleteEventRooms,
      }
    },


  }
</script>
