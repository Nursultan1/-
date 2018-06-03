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
                    <th>Имя</th>
                    <th>Имя</th>
                    <th>Преподователь</th>
                    <th>Изменить</th>
                    <th>Удалить</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="result in results" :key="result.id_item">
                    <td>{{result.id_item}}</td>
                    <td>{{result.name_ru}}</td>
                    <td>{{result.name_eng}}</td>
                    <td>{{result.teache}}</td>
                    <td><button class="btn" @click="showingEditModal=true;select(result);">Изменить</button></td>
                    <td><button class="btn" @click="showingDeleteModal=true;select(result)">Удалить</button></td>
                </tr>
            </tbody>
        </table>
        <button class="btn btn-info" @click="showingAddModal=true;getAllTeache();">Добавить нового ученика</button>

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
                            <label for="fio">Имя на русском</label>
                            <input type="text" class="form-control" v-model="newRecord.name_ru">
                        </div>
                        <div class="form-group">
                            <label for="fio">Имя на английском</label>
                            <input type="text" class="form-control" v-model="newRecord.name_eng">
                        </div>
                        <div class="form-group">
                            <label for="fio">Преподователь</label>
                            <select class="form-control" v-model="newRecord.id_teache">
                                <option v-for="teache in teaches" :key="teache.id_teache" :value="teache.id_teache">{{teache.fio_teache}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-default" @click="showingAddModal = false; save();">Добавить</button>
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
                            <label for="fio">Имя на русском</label>
                            <input type="text" class="form-control" v-model="clicked.name_ru">
                        </div>
                        <div class="form-group">
                            <label for="fio">Имя на английском</label>
                            <input type="text" class="form-control" v-model="clicked.name_eng">
                        </div>
                        <div class="form-group">
                            <label for="fio">Преподователь</label>
                            <select class="form-control" v-model="clicked.id_teache">
                                <option v-for="teache in teaches" :key="teache.id_teache" :value="teache.id_teache">{{teache.fio_teache}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-default" @click="showingEditModal = false; update();getAllTeache();">Добавить</button>
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
                        Вы дествительно хотите удалить {{clicked.name_ru}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" v-on:click="showingDeleteModal=false; deleteRecord()">Да</button>
                        <button type="button" class="btn btn-default" v-on:click="showingDeleteModal=false">Отмена</button>
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
                results: [],
                //teaches:[],
                newRecord: {name_ru: "",name_eng: "", id_teache: ""},
                clicked: {},
            }
        },
        mounted() {
            this.getAll();
        },
        methods: {
            getAll: function(){
                axios.get("http://school.kg/admin/items/ajax/"+this.className)
                .then(function(response){
                    console.log(response);
                    if(response.data.error){
                        this.errorMessage = response.data.message; 
                    } else{
                        this.results = response.data.items;
                    }
                }.bind(this));
            },
            save: function(){
                var formData = this.toFormData(this.newRecord);
                axios.post("http://school.kg/admin/items/ajax/save/"+this.className, formData)
                    .then(function(response){
                        console.log(response);
                        this.newRecord={name_ru: "",name_eng: "", id_teache: ""};
                        if(response.data.error){
                            this.errorMessage = response.data.message; 
                        } else{
                            this.getAll();
                        }
                    }.bind(this));
            },
            update: function(){
                var formData = this.toFormData(this.clicked);
                console.log(this.clicked);
                axios.post("http://school.kg/admin/items/ajax/update/"+this.className, formData)
                .then(function(response){	
                    console.log("fvdfsvfdv");
                    console.log(response);			
                    this.clicked = {name_ru: "",name_eng: "", id_teache: ""};
                    if(response.data.error){
                        this.errorMessage = response.data.message; 
                    } else{
                        this.successMessage = response.data.message; 
                        this.getAll();
                    }
                    // console.log(this.clickedPupil);
                }.bind(this));
            },
            deleteRecord: function(){
                //console.log(app.newUser);
                var id_item=this.clicked.id_item;

                axios.get("http://school.kg/admin/items/ajax/delete/"+this.className+"/"+id_item)
                .then(function(response){	
                    console.log("delete");
                    console.log(response);			
                    this.clicked = {name_ru: "",name_eng: "", id_teache: ""};
                    if(response.data.error){
                        this.errorMessage = response.data.message; 
                    } else{
                        this.successMessage = response.data.message; 
                        this.getAll();
                    }
                }.bind(this));
            },
            getAllTeache: function(){
                axios.get("http://school.kg/admin/teache/ajax-read")
                .then(function(response){				
                    if(response.data.error){
                        this.errorMessage = response.data.message; 
                    } 
                    else{
                        this.teaches = response.data.teaches;
                    }
                }.bind(this));
            },
            toFormData: function(obj){
                var form_data = new FormData();
                for ( var key in obj ) {
                    form_data.append(key, obj[key]);
                } 
                return form_data;
            },
            select(result){
                console.log("selectPupil");
                console.log(result);
                this.clicked = result;
            },
        }
    }
</script>
