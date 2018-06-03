<template>
    <div>
        <p class="bg-danger" v-if="errorMessage">
			{{errorMessage}}
		</p>

		<p class="bg-success" v-if="successMessage">
			{{successMessage}}
		</p>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ФИО</th>
                    <th>E-mail</th>
                    <th>Классы</th>
                    <th>Изменить</th>
                    <th>Удалить</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="teache in teaches" :key="teache.id_teache" >
                    <td>{{teache.id_teache}}</td>
                    <td>{{teache.fio_teache}}</td>
                    <td>{{teache.email}}</td>
                    <td>{{teache.name_class}}</td>
                    <td><button @click="showingEditModal = true; selectTeache(teache)">Изменить</button></td>
                    <td><button @click="showingDeleteModal = true; selectTeache(teache)">Удалить</button></td>
                </tr>
            </tbody>
        </table>
        <div class="modal fade in" role="dialog" style="display: block;" id="deleteModal" v-if="showingDeleteModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Изменить</h4>
                        <button class="fright close" @click="showingDeleteModal = false;">x</button>
                    </div>
                    <div class="modal-body">
                        <p>Удалить предопователя '{{clickedTeache.fio_teache}}'.</p>
                        <button class="btn" @click="showingDeleteModal = false; deleteTeache()">Да</button>
                        <button class="btn" @click="showingDeleteModal = false;">No</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade in" role="dialog" style="display: block;" id="editModal" v-if="showingEditModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Изменить</h4>
                        <button class="fright close" @click="showingEditModal = false;">x</button>
                        <div class="clear"></div>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>ФИО</th>
                                    <td><input type="text" name="" class="form-control" v-model="clickedTeache.fio_teache"> </td>
                                </tr>

                                <tr>
                                    <th>Email</th>
                                    <td><input type="text" class="form-control" name="" v-model="clickedTeache.email"> </td>
                                </tr>
                            </tbody>
                        </table>
                        <button class="btn" @click="showingEditModal = false; updateTeache()">Update</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" @click="showingEditModal = false;">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>

        <h3>Запросы на добавления</h3>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ФИО</th>
                    <th>Email</th>
                    <th>Подвердить</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="request in requests" :key="request.id_teache" >
                    <td>{{request.id_teache}}</td>
                    <td>{{request.fio_teache}}</td>
                    <td>{{request.email}}</td>
                    <td><button @click="selectRequest(request);configRequest(request)">Подвердить</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                showingAddModal: false,
                showingEditModal: false,
                showingDeleteModal: false,
                errorMessage: "",
                successMessage: "",
                teaches: [],
                clickedTeache: {},

                //для таблицы запросов
                requests:[],
                clickedRequest: {},
            }
        },
        mounted() {
            console.log('Компонент преподователи смонтирован');
            this.getAllTeache();
            this.getAllRequest();
        },
        methods: {
            // Функции для запросов
            getAllRequest: function(){
                axios.get("http://school.kg/admin/teache/ajax-read-request")
                .then(function(response){
                    console.log(response);
                    if(response.data.error){
                        this.errorMessage = response.data.message; 
                    } else{
                        this.requests = response.data.requests;
                    }

                }.bind(this));
            },
            selectRequest(request){
                this.clickedRequest = request;
            },
            configRequest: function(){
                var formData = this.toFormData(this.clickedRequest);

                axios.post("http://school.kg/admin/teache/ajax-request-config", formData)
                .then(function(response){	
                    console.log(response);			
                    this.clickedTeache = {};
                    if(response.data.error){
                        this.clearMessage();
                        this.errorMessage = response.data.message; 
                    } else{
                        this.clearMessage();
                        this.successMessage = response.data.message; 
                        this.getAllRequest();
                        this.getAllTeache();
                    }
                }.bind(this));
            },

            // Функции основного таблицы
            getAllTeache: function(){
                axios.get("http://school.kg/admin/teache/ajax-read")
                .then(function(response){
                
                    if(response.data.error){
                        this.errorMessage = response.data.message; 
                    } else{
                        this.teaches = response.data.teaches;
                    }
                    // console.log('teevrfdfgvfdfdvst');
                    console.log(this.teaches['0']);
                }.bind(this));
            },

            updateTeache: function(){

                var formData = this.toFormData(this.clickedTeache);

                console.log('function update');

                axios.post("http://school.kg/admin/teache/ajax-update", formData)
                .then(function(response){				
                    this.clickedTeache = {};
                    if(response.data.error){
                        this.clearMessage();
                        this.errorMessage = response.data.message; 
                    } else{
                        this.clearMessage();
                        this.successMessage = response.data.message; 
                        this.getAllTeache();
                    }
                }.bind(this));
            },

            deleteTeache: function(){
                //console.log(app.newUser);
                var formData = this.toFormData(this.clickedTeache);

                axios.post("http://school.kg/admin/teache/ajax-delete", formData)
                .then(function(response){	
                    console.log(response);			
                    this.clickedTeache = {};
                    if(response.data.error){
                        this.clearMessage();
                        this.errorMessage = response.data.message; 
                    } else{
                        this.clearMessage();
                        this.successMessage = response.data.message; 
                        this.getAllTeache();
                    }
                }.bind(this));
            },

            selectTeache(teache){
                this.clickedTeache = teache;
            },

            toFormData: function(obj){
                var form_data = new FormData();
                for ( var key in obj ) {
                    form_data.append(key, obj[key]);
                }
                return form_data;
            },

            clearMessage: function(){
                this.errorMessage = "";
                this.successMessage = "";
            }
	    }

    }
</script>
