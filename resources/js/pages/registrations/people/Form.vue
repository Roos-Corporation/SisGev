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
                                    <input type="text" class="form-control" name="cpf" autocomplete="off" placeholder="Digite aqui.." value="">
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label for="first_name" class="form-label">Nome</label>
                                    <input type="text" class="form-control" name="first_name" autocomplete="off" placeholder="Digite aqui.." value="">
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label for="last_name" class="form-label">Sobrenome</label>
                                    <input type="text" class="form-control" name="last_name" autocomplete="off" placeholder="Digite aqui.." value="">
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label for="accounting" class="form-label">Contabilidade</label>
                                    <input type="text" class="form-control" name="accounting" autocomplete="off" placeholder="Digite aqui.." value="">
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <label for="date_of_birth" class="form-label">Data de nascimento</label>
                                    <input type="date" class="form-control" name="date_of_birth" autocomplete="off" placeholder="Digite aqui.." value="">
                                </div>

                                <div class="col-sm-3 mb-3">
                                    <label for="gender" class="form-label">Gênero</label>
                                    <select class="form-select" name="gender">
                                        <option value="m">Masculino</option>
                                        <option value="f">Femenino</option>
                                    </select>
                                </div>

                                <div class="col-sm-3 mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <div class="form-check form-switch mb-2">
                                        <input type="checkbox" class="form-check-input" name="status">
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
  export default {
    name: 'FormPeople',
    data() {

        onMounted(async () => {
        })

        const onSubmit = async () => {
            alert('onSubmit')
        }

        return {
            onSubmit
        }
    },


  }
</script>
