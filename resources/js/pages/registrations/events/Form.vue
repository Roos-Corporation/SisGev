<template>

    <div class="page-content">

        <div class="row">

            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">
                    <i class="link-icon" data-feather="user"></i> Cadastrando um novo evento

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
                                    <label for="responsible" class="form-label">Responsável</label>
                                    <input type="text" class="form-control" name="responsible" autocomplete="off" placeholder="Digite aqui.." v-model="form.responsible" required >
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label for="stages" class="form-label">Etapas</label>
                                    <input type="number" class="form-control" name="stages" autocomplete="off" placeholder="Digite aqui.." v-model="form.stages" required>
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
                                        <option value="a">Ativo</option>
                                        <option value="c">Cancelado</option>
                                        <option value="r">Reportado</option>
                                        <option value="f">Finalizado</option>
                                    </select>
                                </div>

                            </div>


                            <button type="submit" class="btn btn-primary ">💾 Salvar</button>
                            ᠎
                            <button type="button"  @click="$router.push('/events')" class="btn btn-secondary ">⬅️ Voltar</button>

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
    name: 'FormEvents',
    data() {

        let form = ref({
            id: null,
            name: '',
            responsible: '',
            stages: '',
            capacity: '',
            location: '',
            status: '',
        });

        const router = useRouter();
        const route = useRoute()

        onMounted(async () => {
            if(route.query.id){
                form.value.id = route.query.id
                getEvent(route.query.id)
            }
        })

        const getEvent = async (id) => {
            let response = await axios.get(`/api/events/${id}`, {
                                headers: {
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                }
                            });
            const event = response.data.data
            form.value.name=event.name;
            form.value.responsible = event.responsible;
            form.value.stages=event.stages;
            form.value.capacity=event.capacity;
            form.value.location=event.location;
            form.value.status = event.status;

        }

        const onSubmit = async () => {
            const formData = new FormData();
            formData.append('name', form.value.name);
            formData.append('responsible', form.value.responsible);
            formData.append('stages', form.value.stages);
            formData.append('capacity', form.value.capacity);
            formData.append('location', form.value.location);
            formData.append('status', form.value.status);

            //Let Update event
            if(form.value.id){
                axios.put(`/api/events/${form.value.id}`, formData, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                } )
                .then((response)=>{
                        router.push('/events');
                        toast.fire({
                            icon:"success",
                            title:"Evento atualizado com successo"
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
                axios.post("/api/events", formData, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                } )
                .then((response)=>{
                        router.push('/events');
                        toast.fire({
                            icon:"success",
                            title:"Evento cadastrado com successo"
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
            onSubmit
        }
    },


  }
</script>
