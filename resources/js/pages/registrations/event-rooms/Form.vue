<template>

    <div class="page-content">

        <div class="row">

            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">
                    <i class="link-icon" data-feather="user"></i> Cadastrando uma nova sala de evento

                  </h6>
                </div>
              </div>
            </div>

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <form v-on:submit.prevent="onSubmit" class="form">
                            <div class="row">

                                <div class="col-sm-6 mb-3">
                                    <label for="name" class="form-label">Nome</label>
                                    <input type="text" class="form-control" name="name" autocomplete="off" placeholder="Digite aqui.." v-model="form.name" required>
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label for="capacity" class="form-label">Capacidade</label>
                                    <input type="number" class="form-control" name="capacity" autocomplete="off" placeholder="Digite aqui.." v-model="form.capacity" required>
                                </div>

                                <div class="col-sm-3 mb-3">
                                    <label for="location" class="form-label">Localização</label>
                                    <input type="text" class="form-control" name="location" autocomplete="off" placeholder="Digite aqui.." v-model="form.location" required>
                                </div>

                                <div class="col-sm-3 mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" name="status" v-model="form.status" required>
                                        <option value="d">Disponível</option>
                                        <option value="m">Em manutenção</option>
                                        <option value="r">Reservada</option>
                                    </select>
                                </div>

                                <div class="col-md-12 grid-margin stretch-card" v-if="form.id">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="dataTableList" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Evento</th>
                                                            <th>Particiante</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(eventStage,i) in eventStages" :key="i">
                                                            <td>{{ eventStage.event_name }}</td>
                                                            <td>{{ eventStage.person_first_name + '' + eventStage.person_last_name }}</td>
                                                            <td>
                                                                {{
                                                                    eventStage.event_participant_status == 'a' ? 'confirmado' :
                                                                    eventStage.event_participant_status == 'c' ? 'Cancelado' :
                                                                    eventStage.event_participant_status == 'r' ? 'Reservado' : ''
                                                                }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <button type="submit" class="btn btn-primary ">💾 Salvar</button>
                            ᠎
                            <button type="button"  @click="$router.push('/event-rooms')" class="btn btn-secondary ">⬅️ Voltar</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>

</template>

<script>
  import { onMounted, ref } from 'vue'
  import { useRouter, useRoute  } from 'vue-router'
  import { convertToDatable } from '../../../components/datable.js'
import Swal from 'sweetalert2';

  export default {
    name: 'FormEventRoom',
    data() {

        let form = ref({
            id: null,
            name: '',
            capacity: '',
            location: '',
            status: '',
        });
        let eventStages = ref([]);

        const router = useRouter();
        const route = useRoute()
        onMounted(async () => {
            if(route.query.id){

                Swal.fire({
                    title: 'Por favor aguarde!',
                    text: "Carregando...",
                    icon:"warning",
                    showCancelButton:false,
                    showConfirmButton:false,
                    time: 3000,
                    timeProgressBar:true,

                })
                form.value.id = route.query.id
                await getEventRoom(route.query.id)
                Swal.close();
            }
        })

        const getEventRoom = async (id) => {
            let response = await axios.get(`/api/event-rooms/${id}`, {
                                headers: {
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                }
                            });
            const eventRoom = response.data.data
            form.value.name=eventRoom.name;
            form.value.capacity=eventRoom.capacity;
            form.value.location=eventRoom.location;
            form.value.status = eventRoom.status;


            let responseStep = await axios.get(`/api/event-stage-participants?filter=event_room_id:${id}`, {
                                headers: {
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                }
                            });
            eventStages.value =responseStep.data.data


            //Set table to an datable
            convertToDatable('dataTableList')

        }

        const onSubmit = async () => {
            const formData = new FormData();
            formData.append('name', form.value.name);
            formData.append('capacity', form.value.capacity);
            formData.append('location', form.value.location);
            formData.append('status', form.value.status);

            //Let Update event
            if(form.value.id){
                axios.put(`/api/event-rooms/${form.value.id}`, formData, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                } )
                .then((response)=>{
                        router.push('/event-rooms');
                        toast.fire({
                            icon:"success",
                            title:"Sala de evento atualizada com successo"
                        });
                }).catch((error)=>{

                    Swal.fire(
                            'Falhou',
                            error.message,
                            'error'
                     );
                });
            } else {
                //Let Insert event
                axios.post("/api/event-rooms", formData, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                } )
                .then((response)=>{
                        router.push('/event-rooms');
                        toast.fire({
                            icon:"success",
                            title:"Sala de evento cadastrada com successo"
                        });
                }).catch((error)=>{

                    Swal.fire(
                            'Falhou',
                            error.message,
                            'error'
                     );
                });
            }

        }

        return {
            form,
            onSubmit,
            eventStages
        }
    },


  }
</script>
