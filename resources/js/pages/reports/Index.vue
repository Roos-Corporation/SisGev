<template>
    <div class="page-content">
        <div class="row">

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            <i class="link-icon" data-feather="book-open"></i> Consultas
                        </h6>
                        <div class="mb-4">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="reportBy" id="reportByPeople" value="people" v-model="reportBy" @click="handleGetReport">
                                <label class="form-check-label" for="reportByPeople"> Pessoas </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="reportBy" id="reportByEventRoom" value="eventRoom" v-model="reportBy" @click="handleGetReport">
                                <label class="form-check-label" for="reportByEventRoom"> Salas do evento </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="reportBy" id="reportByCoffeeSpace" value="coffeeSpace" v-model="reportBy" @click="handleGetReport">
                                <label class="form-check-label" for="reportByCoffeeSpace"> Espaços de café </label>
                            </div>
                        </div>
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
                                        <th  v-for="(columnName,i) in columnsNames" :key="i">
                                            {{ columnName }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!-- If report by people -->
                                    <tr v-if="reportBy=='people'" v-for="(person,i) in rows" :key="i">

                                        <td>{{ person.id }}</td>
                                        <td>{{ person.firstName }}</td>
                                        <td>{{ person.lastName }}</td>
                                        <td>{{ person.accounting }}</td>
                                        <td >
                                            {{ person.gender == 'f' ? 'Femenino' : 'Masculino' }}
                                        </td>
                                        <td>
                                            <div class="form-check form-switch mb-2">
                                                <input disabled
                                                :checked="person.status == 'a' ? true : false" type="checkbox" class="form-check-input" id="formSwitch1">
                                            </div>
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-primary btn-xs ml-4" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" @click="handleGetAllPeopleInRoomAndCoffee(person)">
                                                👁️
                                            </button>
                                        </td>

                                    </tr>

                                    <!-- If report by eventRoom -->
                                    <tr v-if="reportBy=='eventRoom'" v-for="(eventRoom,i) in rows" :key="i">

                                        <td>{{ eventRoom.id }}</td>
                                        <td>{{ eventRoom.name }}</td>
                                        <td>{{ eventRoom.responsible }}</td>
                                        <td>{{ eventRoom.stages }}</td>
                                        <td>{{ eventRoom.capacity }}</td>
                                        <td>{{ eventRoom.location }}</td>
                                        <td>

                                            {{
                                                eventRoom.status == 'a' ? 'Ativo' :
                                                eventRoom.status == 'c' ? 'Cancelado' :
                                                eventRoom.status == 'r' ? 'Reportado' :
                                                eventRoom.status == 'f' ? 'Finalizado' : ''

                                            }}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-xs ml-4" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" @click="handleGetAllPeopleInRoom(eventRoom)">
                                                👁️
                                            </button>
                                        </td>

                                    </tr>

                                    <!-- If report by coffeeSpace -->
                                    <tr v-if="reportBy=='coffeeSpace'" v-for="(coffeeSpace,i) in rows" :key="i">

                                        <td>{{ coffeeSpace.id }}</td>
                                        <td>{{ coffeeSpace.name }}</td>
                                        <td>{{ coffeeSpace.capacity }}</td>
                                        <td>{{ coffeeSpace.location }}</td>
                                        <td>

                                            {{
                                                coffeeSpace.status == 'd' ? 'Disponível' :
                                                coffeeSpace.status == 'm' ? 'Em manutenção' :
                                                coffeeSpace.status == 'r' ? 'Reservada' : ''

                                            }}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-xs ml-4" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" @click="handleGetAllPeopleInCoffeeSpace(coffeeSpace)">
                                                👁️
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


    <!-- Extra large modal -->
    <div class="modal fade bd-example-modal-xl" tabindex="-1" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title h4" id="myExtraLargeModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">
                    </button>
                </div>
                <div class="modal-body">

                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTableModalList" class="table">
                                    <thead>
                                        <tr>

                                            <th  v-for="(columnName,i) in columnsModalNames" :key="i">
                                                {{ columnName }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if="reportBy=='people'" v-for="(eventStage,i) in eventStages" :key="i">
                                            <td>{{ eventStage.event_name }}</td>
                                            <td>{{ eventStage.step }}</td>
                                            <td>{{ eventStage.event_room_name }}</td>
                                            <td>{{ eventStage.coffee_space_name }}</td>
                                        </tr>
                                        <tr v-if="reportBy=='eventRoom' || reportBy=='coffeeSpace'" v-for="(eventStage,i) in eventStages" :key="i">
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
        </div>
    </div>

</template>

<script>
  import { onMounted, ref } from 'vue'
  import { useRouter } from 'vue-router'
  import { convertToDatable } from '../../components/datable.js'
import Swal from 'sweetalert2';

  export default {
    name: 'IndexEventParticipants',
    data() {
        const router = useRouter();
        const reportBy = ref();
        const columnsNames = ref([]);
        const rows = ref([]);
        let eventStages = ref([]);
        const columnsModalNames = ref([]);

        const handleGetReport = async (event) => {
            Swal.fire({
                title: 'Por favor aguarde!',
                text: "Carregando...",
                icon:"warning",
                showCancelButton:false,
                showConfirmButton:false,
                time: 3000,
                timeProgressBar:true,

            })
            const reportBy = event.target.value;
            columnsNames.value= [];
            rows.value= [];
            columnsModalNames.value = [];

            //Let`s get report by type
            if( reportBy === 'people' ){
                columnsNames.value.push('Código');
                columnsNames.value.push('Nome');
                columnsNames.value.push('Sobrenome');
                columnsNames.value.push('Contabilidade');
                columnsNames.value.push('Gênero');
                columnsNames.value.push('Status');
                columnsNames.value.push('Ação');

                columnsModalNames.value.push('Evento');
                columnsModalNames.value.push('Etapa');
                columnsModalNames.value.push('Salas do evento');
                columnsModalNames.value.push('Espaços de café');

                await getPeople();
            } else if( reportBy === 'eventRoom' ){
                columnsNames.value.push('Código');
                columnsNames.value.push('Nome');
                columnsNames.value.push('Capacidade');
                columnsNames.value.push('Localização');
                columnsNames.value.push('Ação');


                columnsModalNames.value.push('Evento');
                columnsModalNames.value.push('Particiante');
                columnsModalNames.value.push('Status');

                await getEventRooms();
            } else if( reportBy === 'coffeeSpace' ){
                columnsNames.value.push('Código');
                columnsNames.value.push('Nome');
                columnsNames.value.push('Capacidade');
                columnsNames.value.push('Localização');
                columnsNames.value.push('Ação');

                columnsModalNames.value.push('Evento');
                columnsModalNames.value.push('Particiante');
                columnsModalNames.value.push('Status');

                await getCoffeeSpaces();
            }

            // router.push('/report');
            Swal.close()
        }
        const getPeople = async () => {
            //Set table to an datable
            let response = await axios.get("api/people");
            rows.value = response.data.data

            // convertToDatable('dataTableList')
        }

        const getEventRooms = async () => {
            let response = await axios.get("api/event-rooms");
            rows.value = response.data.data
        }

        const getCoffeeSpaces = async () => {
            let response = await axios.get("api/coffee-spaces");
            rows.value = response.data.data
        }

        const handleGetAllPeopleInRoom = async (eventRoom) => {
            Swal.fire({
                title: 'Por favor aguarde!',
                text: "Carregando...",
                icon:"warning",
                showCancelButton:false,
                showConfirmButton:false,
                time: 3000,
                timeProgressBar:true,

            })
            eventStages.value = [];
            let responseStep = await axios.get(`/api/event-stage-participants?filter=event_room_id:${eventRoom.id}`, {
                                headers: {
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                }
                            });
            eventStages.value =responseStep.data.data

            $('#myExtraLargeModalLabel').text('Lista das pessoas da sala : ' + eventRoom.name);
            $('.modal').modal('show');
            //Set table to an datable
            // convertToDatable('dataTableModalList')
            Swal.close()
        }

        const handleGetAllPeopleInCoffeeSpace = async (coffeeSpace) => {
            Swal.fire({
                title: 'Por favor aguarde!',
                text: "Carregando...",
                icon:"warning",
                showCancelButton:false,
                showConfirmButton:false,
                time: 3000,
                timeProgressBar:true,

            })
            eventStages.value = []
            let responseStep = await axios.get(`/api/event-stage-participants?filter=coffee_space_id:${coffeeSpace.id}`, {
                                headers: {
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                }
                            });
            eventStages.value =responseStep.data.data

            $('#myExtraLargeModalLabel').text('Lista das pessoas do espaços de café : ' + coffeeSpace.name);
            $('.modal').modal('show');
            //Set table to an datable
            // convertToDatable('dataTableModalList')
            Swal.close()
        }


        const handleGetAllPeopleInRoomAndCoffee = async (person) => {
            Swal.fire({
                title: 'Por favor aguarde!',
                text: "Carregando...",
                icon:"warning",
                showCancelButton:false,
                showConfirmButton:false,
                time: 3000,
                timeProgressBar:true,

            })
            eventStages.value = []
            let responseStep = await axios.get(`/api/event-stage-participants?filter=people_id:${person.id}`, {
                                headers: {
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                }
                            });
            eventStages.value =responseStep.data.data

            $('#myExtraLargeModalLabel').text('Lista salas de eventos e espaços de café para : ' + person.firstName + ' ' + person.lastName);
            $('.modal').modal('show');
            //Set table to an datable
            // convertToDatable('dataTableModalList')
            Swal.close()
        }


        onMounted(async () => {

            // await getEventParticipants();
            // Swal.close();
        })

      return {
        reportBy,
        handleGetReport,
        columnsNames,
        rows,
        eventStages,
        handleGetAllPeopleInRoom,
        handleGetAllPeopleInCoffeeSpace,
        handleGetAllPeopleInRoomAndCoffee,
        columnsModalNames
      }
    },


  }
</script>
