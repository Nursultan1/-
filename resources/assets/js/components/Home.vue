<template>
    <div class="container">
        <div class="panel panel-default col-md-10">
            <div class="panel-heading">
                Личные данные
            </div>
            <div class="panel-body">
                <div class="alert alert-danger" v-if="errorMessage">
                    <strong>Ошибка!</strong> Не удалось изменить данные
                </div>
                <div>
                    ФИО:
                    <h4>{{teache.fio_teache}}</h4>
                    <button class="btn" @click="showingEditModalFio=true">&#9998;</button> 
                </div>
                <hr>
                <div>
                    Email:
                    <h4>{{teache.email}}</h4>
                    <button class="btn" @click="showingEditModalEmail=true">&#9998;</button> 
                </div>
                <hr>
                <div>
                    Пароль:
                    <button class="btn" @click="showingEditModalPass=true">&#9998;</button> 
                </div>
                <hr> 
            </div>
        </div>
        <!-- Modal -->
        <div  class="modal fade in " role="dialog" style="display: block;" v-if="showingEditModalFio" >
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Изменить</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fio">Введите ФИО:</label>
                            <input type="text" class="form-control"  v-model="teache.fio_teache">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-default" @click="showingEditModalFio = false; edit()"> Изменить</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" v-on:click="showingEditModalFio=false">Отмена</button>
                    </div>
                </div>
            </div>
        </div>
        <div  class="modal fade in " role="dialog" style="display: block;" v-if="showingEditModalEmail" >
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Изменить</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fio">Введите email</label>
                            <input type="text" class="form-control"  v-model="teache.email">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-default" @click="showingEditModalEmail = false; edit()"> Изменить</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" v-on:click="showingEditModalEmail=false">Отмена</button>
                    </div>
                </div>
            </div>
        </div>
        <div  class="modal fade in " role="dialog" style="display: block;" v-if="showingEditModalPass" >
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Изменить</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fio">Введите текущий пароль</label>
                            <input type="text" class="form-control"  v-model="pass.current" @change="handlerChange()">
                            <label for="fio">Введите новый пароль</label>
                            <input type="text" class="form-control"  v-model="pass.new" @change="handlerChange()">
                            <label for="fio">Повторите новый пароль</label>
                            <input type="text" class="form-control"  v-model="pass.new2" @change="handlerChange()">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-default" @click="showingEditModalPass = false; editPassword()"> Изменить</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" v-on:click="showingEditModalPass=false">Отмена</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['id','fio','email'],
        data () {
            return {
                showingEditModalFio: false,
                showingEditModalEmail: false,
                showingEditModalPass: false,
                errorMessage:'',
                errorInput:'',
                pass:{current:'', new:'', new2:''},
                teache:{id_teache:'', fio_teache:'', email:''}
            }
        },
        mounted() {
            console.log('Home component mounted.')
            this.teache.id_teache=this.id;
            this.teache.fio_teache=this.fio;
            this.teache.email=this.email;
            
        },
        methods:{
            handlerChange:function(event){
                
            },
            edit:function(){
                var form_data=this.toFormData(this.teache);
                axios.post('http://school.kg/home/teache/edit/ajax', form_data)
                .then(function(response){
                    console.log(response);
                    if(response.data.error){
                        this.errorMessage = response.data.message; 
                    } else{
                        this.pupilList = response.data.pupils;
                    }
                }.bind(this));
            },
            editPassword:function(){
                if(this.pass.new===this.pass.new2){
                    var form_data=this.toFormData(this.pass);
                    axios.post('http://school.kg/home/teache/edit-password/ajax', form_data)
                    .then(function(response){
                        console.log(response);
                        if(response.data.error){
                            this.errorMessage = response.data.message; 
                        } else{
                            this.pass={current:'', new:'', new2:''};
                        }
                    }.bind(this));
                }
                else{
                    this.errorMessage="Пароли не совпадают";
                }
            },
            toFormData: function(obj){
                var form_data = new FormData();
                for ( var key in obj ) {
                    form_data.append(key, obj[key]);
                } 
                return form_data;
            },
        }
    }
</script>
