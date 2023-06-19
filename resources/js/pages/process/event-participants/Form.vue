<template>

    <div class="page-content">

        <div class="row">

            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">
                    <i class="link-icon" data-feather="user"></i> Cadastrando uma nova pessoa

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
                                    <label for="cpf" class="form-label">CPF</label>
                                    <input type="text" class="form-control" name="cpf" autocomplete="off" placeholder="Digite aqui.." v-model="form.cpf" required min="11" max="13" >
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label for="first_name" class="form-label">Nome</label>
                                    <input type="text" class="form-control" name="first_name" autocomplete="off" placeholder="Digite aqui.." v-model="form.first_name" required>
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label for="last_name" class="form-label">Sobrenome</label>
                                    <input type="text" class="form-control" name="last_name" autocomplete="off" placeholder="Digite aqui.." v-model="form.last_name" required >
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label for="accounting" class="form-label">Contabilidade</label>
                                    <input type="text" class="form-control" name="accounting" autocomplete="off" placeholder="Digite aqui.." v-model="form.accounting" required>
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label for="date_of_birth" class="form-label">Data de nascimento</label>
                                    <input type="date" class="form-control" name="date_of_birth" autocomplete="off" placeholder="Digite aqui.." v-model="form.date_of_birth" required>
                                </div>

                                <div class="col-sm-3 mb-3">
                                    <label for="gender" class="form-label">Gênero</label>
                                    <select class="form-select" name="gender" v-model="form.gender" required>
                                        <option value="m">Masculino</option>
                                        <option value="f">Femenino</option>
                                    </select>
                                </div>

                                <div class="col-sm-3 mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <div class="form-check form-switch mb-2">
                                        <input type="checkbox" class="form-check-input" name="status" v-model="form.status" :checked="form.status == 'a' ? true : false">
                                    </div>
                                </div>

                            </div>


                            <button type="submit" class="btn btn-primary ">💾 Salvar</button>
                            ᠎
                            <button type="button"  @click="$router.push('/people')" class="btn btn-secondary ">⬅️ Voltar</button>

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

        let form = ref({
            id: null,
            cpf: '',
            first_name: '',
            last_name: '',
            accounting: '',
            date_of_birth: '',
            gender: '',
            status: false,
        });

        const router = useRouter();
        const route = useRoute()

        onMounted(async () => {
            if(route.query.id){
                form.value.id = route.query.id
                getPerson(route.query.id)
            }
        })

        const getPerson = async (id) => {
            let response = await axios.get(`/api/people/${id}`, {
                                headers: {
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                }
                            });
            const person = response.data.data
            form.value.cpf = person.cpf;
            form.value.last_name = person.lastName;
            form.value.first_name=person.firstName;
            form.value.accounting=person.accounting;
            form.value.date_of_birth=person.dateOfBirth;
            form.value.gender=person.gender;
            form.value.status = false;
            if(person.status == 'a'){
                form.value.status = true;
            }

        }

        const onSubmit = async () => {
            const formData = new FormData();
            let status   = await 'i';
            if(form.value.status){
                status='a'
            }
            if(form.value.cpf.length > 15 || form.value.cpf.length  < 11) {
                Swal.fire(
                    'Erro',
                    'CPF inválido',
                    'error'
                );
                return;
            }

            formData.append('cpf', form.value.cpf);
            formData.append('first_name', form.value.first_name);
            formData.append('last_name', form.value.last_name);
            formData.append('accounting', form.value.accounting);
            formData.append('date_of_birth', form.value.date_of_birth);
            formData.append('gender', form.value.gender);
            formData.append('status', status);

            //Let Update person
            if(form.value.id){
                axios.put(`/api/people/${form.value.id}`, formData, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                } )
                .then((response)=>{
                        router.push('/people');
                        toast.fire({
                            icon:"success",
                            title:"Pessoa atualizada com successo"
                        });
                }).catch((error)=>{

                    Swal.fire(
                            'Falhou',
                            error.message,
                            'error'
                     );
                });
            } else {
                //Let Insert person
                axios.post("/api/people", formData, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                } )
                .then((response)=>{
                        router.push('/people');
                        toast.fire({
                            icon:"success",
                            title:"Pessoa cadastrada com successo"
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
