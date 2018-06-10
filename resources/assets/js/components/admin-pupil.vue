<template>
    <div>
        <p class="bg-danger" v-if="errorMessage">
			{{errorMessage}}
		</p>

		<p class="bg-success" v-if="successMessage">
			{{successMessage}}
		</p>
        <h2>{{ className }}-класс</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ФИО</th>
                    <th>Изменить</th>
                    <th>Удалить</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="pupil in pupils" :key="pupil.id_pupil">
                    <td>{{pupil.id_pupil}}</td>
                    <td>{{pupil.fio_pupil}}</td>
                    <td><button class="btn" @click="showingEditModal=true;selectPupil(pupil)">Изменить</button></td>
                    <td><button class="btn" @click="showingDeleteModal=true;selectPupil(pupil)">Удалить</button></td>
                </tr>
            </tbody>
        </table>
        <button class="btn btn-info" @click="showingAddModal=true">Добавить нового ученика</button>

        <!-- Modal -->
        <div  class="modal fade in " role="dialog" style="display: block;" v-if="showingAddModal">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Добавить нового ученика</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fio">ФИО</label>
                            <input type="text" class="form-control" v-model="newPupil.fio_pupil">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-default" @click="showingAddModal = false; savePupil();">Добавить</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" v-on:click="showingAddModal=false">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>
        <div  class="modal fade in " role="dialog" style="display: block;" v-if="showingEditModal">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Изменить</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fio">ФИО</label>
                            <input type="text" class="form-control" v-model="clickedPupil.fio_pupil">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-default" @click="showingEditModal = false; updatePupil();">Изменить</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" v-on:click="showingEditModal=false">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>
        <div  class="modal fade in " role="dialog" style="display: block;" v-if="showingDeleteModal">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Изменить</h4>
                    </div>
                    <div class="modal-body">
                        Вы дествительно хотите удалить {{clickedPupil.fio_pupil}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" v-on:click="showingDeleteModal=false; deletePupil()">Да</button>
                        <button type="button" class="btn btn-default" v-on:click="showingEditModal=false">Отмена</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ["className"],
        data () {
            return {
                showingAddModal: false,
                showingEditModal: false,
                showingDeleteModal: false,
                errorMessage: "",
                successMessage: "",
                pupils: [],
                newPupil: {fio_pupil: ""},
                clickedPupil: {},
            }
        },
        mounted() {
            console.log('Component mounted.');
            this.getAllPupil();
        },
        methods: {
            getAllPupil: function(){
                axios.get("http://school.kg/admin/pupils/ajax/"+this.className)
                .then(function(response){
                    console.log(response);
                    if(response.data.error){
                        this.errorMessage = response.data.message; 
                    } else{
                        this.pupils = response.data.pupils;
                    }
                }.bind(this));
            },
            savePupil: function(){
                var formData = this.toFormData(this.newPupil);

                axios.post("http://school.kg/admin/pupils/ajax/save/"+this.className, formData)
                    .then(function(response){
                        
                        this.newPupil = {fio_pupil: ""};

                        if(response.data.error){
                            this.errorMessage = response.data.message; 
                        } else{
                            this.getAllPupil();
                        }
                    }.bind(this));
            },
            updatePupil: function(){
                //console.log(app.newUser);
                var formData = this.toFormData(this.clickedPupil);

                axios.post("http://school.kg/admin/pupils/ajax/update/"+this.className, formData)
                .then(function(response){				
                    this.clickedPupil = {fio_pupil: "",id_pupil: ""};
                    if(response.data.error){
                        this.errorMessage = response.data.message; 
                    } else{
                        this.successMessage = response.data.message; 
                        this.getAllPupil();
                    }
                    console.log(this.clickedPupil);
                }.bind(this));
            },
            deletePupil: function(){
                //console.log(app.newUser);
                var formData = this.toFormData(this.clickedPupil);

                axios.post("http://school.kg/admin/pupils/ajax/delete/"+this.className, formData)
                .then(function(response){				
                    this.clickedPupil = {};
                    if(response.data.error){
                        this.errorMessage = response.data.message; 
                    } else{
                        this.successMessage = response.data.message; 
                        this.getAllPupil();
                    }
                    console.log(this.clickedPupil);
                }.bind(this));
            },
            toFormData: function(obj){
                var form_data = new FormData();
                for ( var key in obj ) {
                    form_data.append(key, obj[key]);
                } 
                return form_data;
            },
            selectPupil(pupil){
                console.log(this.clickedPupil);
                this.clickedPupil = pupil;
            },
        }
    }
</script>
