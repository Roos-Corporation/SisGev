<template>

    <div class="page-content">

        <div class="row">

            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">
                    <i class="link-icon" data-feather="user"></i> Cadastrando um novo participante

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
                                    <label for="event" class="form-label">Evento</label>
                                    <select class="form-control" v-model="formEventParticipant.event_id" required @change="handleChangeEvent($event)">
                                        <option> -- Escolhe uma opção -- </option>
                                        <option v-for="event in events" :value="event.id" :attrStep="event.stages" :attrCapacity="event.capacity" >{{ event.name }}</option>
                                    </select>
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label for="person" class="form-label">Pessoa</label>
                                    <select class="form-control" v-model="formEventParticipant.person_id"  required @change="handlePeopleEvent($event)">
                                        <option> -- Escolhe uma opção -- </option>
                                        <option v-for="person in people" :value="person.id" >{{ ' CPF : '+  person.cpf +' '+ person.firstName +' '+ person.lastName  }}</option>
                                    </select>
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label for="ticket" class="form-label"># Ticket</label>
                                    <input type="text" class="form-control text-uppercase" name="ticket" autocomplete="off" placeholder="Digite aqui.." v-model="formEventParticipant.ticket_number" >
                                </div>

                                <div class="col-sm-3 mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" name="status" v-model="formEventParticipant.status" required>
                                        <option value="a">Confirmado</option>
                                        <option value="c">Cancelado</option>
                                        <option value="r">Reservado</option>
                                    </select>
                                </div>


                                <div class="col-md-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Etapa</th>
                                                            <th>Sala</th>
                                                            <th>Coffee space</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(eventStage,i) in eventStages" :key="i">
                                                            <td>{{ i+1 }}</td>
                                                            <td>
                                                                <select class="form-control" required  v-model="eventStage.event_room_id">
                                                                    <option> -- Escolhe uma opção -- </option>
                                                                    <option v-for="eventRoom in eventRooms" :value="eventRoom.id">{{ eventRoom.name }}</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="form-control" required  v-model="eventStage.coffee_space_id" >
                                                                    <option> -- Escolhe uma opção -- </option>
                                                                    <option v-for="offeeSpace in coffeeSpaces" :value="offeeSpace.id">{{ offeeSpace.name }}</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="form-select"  required v-model="eventStage.status">
                                                                    <option> -- Escolhe uma opção -- </option>
                                                                    <option value="a">Confirmado</option>
                                                                    <option value="c">Cancelado</option>
                                                                    <option value="r">Reservado</option>
                                                                </select>
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
                            <button type="button"  @click="$router.push('/event-participants')" class="btn btn-secondary ">⬅️ Voltar</button>

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

  export default {
    name: 'FormPeople',
    data() {

        let formEventParticipant = ref({
            id: null,
            event_id: null,
            event_stage: null,
            person_id: null,
            ticket_number:   (Math.random() + 1).toString(36).substring(7) +'-'+ Math.random().toString(36).slice(2, 5),
            status: 'a'
        });

        const router = useRouter();
        const route = useRoute()
        let events = ref([]);
        let people = ref([]);
        let eventStages = ref([]);
        let eventRooms = ref([]);
        let coffeeSpaces = ref([]);

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
            //let's get the list of event first
            await getEvents();
            //let's get the list of People
            await getPeople();
            //let's get the list of EventRooms
            await getEventRooms()
            //let's get the list of CoffeeSpaces
            await getCoffeeSpaces()

            if(route.query.id){
                formEventParticipant.value.id = route.query.id
                getEventParticipant(route.query.id)
            }
            Swal.close()
        })


        const getEvents = async () => {
            let response = await axios.get("/api/events", {
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    });
            events.value = response.data.data
        }


        const getPeople = async () => {
            let response = await axios.get("/api/people", {
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    });
            people.value = response.data.data
        }

        const getEventRooms = async () => {
            let response = await axios.get("/api/event-rooms");

            eventRooms.value = response.data.data
        }

        const getCoffeeSpaces = async () => {
            let response = await axios.get("/api/coffee-spaces");
            coffeeSpaces.value = response.data.data
        }


        const handleChangeEvent = async (event) => {
            var options = event.target.options
            if (options.selectedIndex > -1) {
                var attrStep = options[options.selectedIndex].getAttribute('attrStep');
                formEventParticipant.event_id = options[options.selectedIndex].value
                formEventParticipant.event_stage = attrStep
                funLoaEventStageParticipant()
            }

        }

        const handlePeopleEvent = async (event) => {
            var options = event.target.options
            if (options.selectedIndex > -1) {
                formEventParticipant.person_id = options[options.selectedIndex].value
                funLoaEventStageParticipant()
            }

        }

        const funLoaEventStageParticipant = async () => {
            //Let's check if the user choose event and person
            if(formEventParticipant.event_id && formEventParticipant.person_id ){
                // eventStage.value=splice(0, eventStage.length);
                eventStages.value = [];
                for (let index = 0; index < formEventParticipant.event_stage; index++) {
                    eventStages.value.push({
                        'event_room_id': '',
                        'coffee_space_id': '',
                        'status': 'a'
                    })
                }
            }
        }




        const getEventParticipant = async (id) => {
            let response = await axios.get(`/api/event-participants/${id}`, {
                                headers: {
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                }
                            });
            const eventParticipant = response.data.data
            formEventParticipant.value.event_id = eventParticipant.event_id
            formEventParticipant.value.person_id = eventParticipant.person_id
            formEventParticipant.value.ticket_number = eventParticipant.ticket_number
            formEventParticipant.value.status = eventParticipant.status

            //Let get all stage for this participant on this event

            let responseStep = await axios.get(`/api/event-stage-participants?filter=${id}`, {
                                headers: {
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                }
                            });
            eventStages.value =responseStep.data.data
        }

        const onSubmit = async () => {

            const formData = new FormData();


            formData.append('event_id', formEventParticipant.value.event_id);
            formData.append('person_id', formEventParticipant.value.person_id);
            formData.append('ticket_number', formEventParticipant.value.ticket_number);
            formData.append('status', formEventParticipant.value.status);

            //Let Update Event Participant
            if(formEventParticipant.value.id){

                Swal.fire({
                    title: 'Por favor aguarde!',
                    text: "Salvando...",
                    icon:"warning",
                    showCancelButton:false,
                    showConfirmButton:false,
                    time: 3000,
                    timeProgressBar:true,

                })
                await axios.put(`/api/event-participants/${formEventParticipant.value.id}`, formData, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                } )
                .then(async (response)=>{
                       const res =  await funSaveStageEventParticipant(formEventParticipant.value.id)

                    toast.fire({
                        icon:"success",
                    title:"Participante atualizada com successo"
                    });
                    router.push('/event-participants');
                }).catch((error)=>{

                    Swal.fire(
                            'Falhou',
                            error.message,
                            'error'
                     );
                });
            } else {
                //Let Insert Event Participant

                Swal.fire({
                    title: 'Por favor aguarde!',
                    text: "Salvando...",
                    icon:"warning",
                    showCancelButton:false,
                    showConfirmButton:false,
                    time: 3000,
                    timeProgressBar:true,

                })
                await axios.post("/api/event-participants", formData, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                } )
                .then(async (response)=>{

                       const res =  await funSaveStageEventParticipant(response.data.data.id)

                        toast.fire({
                            icon:"success",
                            title:"Participante cadastrada com successo"
                        });
                        router.push('/event-participants');
                }).catch((error)=>{

                    Swal.fire(
                            'Falhou',
                            error.message,
                            'error'
                     );
                });
            }

        }

        const funSaveStageEventParticipant = async (idParticipant) => {

            //Delete all step before save
            await axios.delete(`/api/event-stage-participants/${idParticipant}`, {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })

            for (let index = 0; index < eventStages.value.length; index++) {

                const formData = new FormData();
                formData.append('event_participant_id', idParticipant);
                formData.append('event_room_id', eventStages.value[index].event_room_id);
                formData.append('coffee_space_id', eventStages.value[index].coffee_space_id);
                formData.append('status', eventStages.value[index].status);

               await axios.post("/api/event-stage-participants", formData, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                } )
                .then((response)=>{
                    // console.log(response)
                }).catch((error)=>{
                    Swal.fire(
                            'Falhou',
                            error.message,
                            'error'
                        );
                    return false
                });
            }

            return true
        }

        return {
            events,
            people,
            handleChangeEvent,
            handlePeopleEvent,
            eventRooms,
            eventStages,
            coffeeSpaces,
            formEventParticipant,
            onSubmit
        }
    },


  }
</script>
