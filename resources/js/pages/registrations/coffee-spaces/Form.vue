<template>

    <div class="page-content">

        <div class="row">

            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">
                    <i class="link-icon" data-feather="user"></i> Cadastrando um novo espaço de coffee

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

                            </div>


                            <button type="submit" class="btn btn-primary ">💾 Salvar</button>
                            ᠎
                            <button type="button"  @click="$router.push('/coffee-spaces')" class="btn btn-secondary ">⬅️ Voltar</button>

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
    name: 'FormCoffeeSpace',
    data() {

        let form = ref({
            id: null,
            name: '',
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
            let response = await axios.get(`/api/coffee-spaces/${id}`, {
                                headers: {
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                }
                            });
            const coffeeSpace = response.data.data
            form.value.name=coffeeSpace.name;
            form.value.capacity=coffeeSpace.capacity;
            form.value.location=coffeeSpace.location;
            form.value.status = coffeeSpace.status;

        }

        const onSubmit = async () => {
            const formData = new FormData();
            formData.append('name', form.value.name);
            formData.append('capacity', form.value.capacity);
            formData.append('location', form.value.location);
            formData.append('status', form.value.status);

            //Let Update event
            if(form.value.id){
                axios.put(`/api/coffee-spaces/${form.value.id}`, formData, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                } )
                .then((response)=>{
                        router.push('/coffee-spaces');
                        toast.fire({
                            icon:"success",
                            title:"Espaço de coffee atualizada com successo"
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
                axios.post("/api/coffee-spaces", formData, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                } )
                .then((response)=>{
                        router.push('/coffee-spaces');
                        toast.fire({
                            icon:"success",
                            title:"Espaço de coffee cadastrado com successo"
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
