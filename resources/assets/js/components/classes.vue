<template>
    <div class="col-lg-3 col-lg-offset-1  col-md-3 col-md-offset-1  col-sm-4 col-sm-offset-1  col-xs-10 " >
        <div class="panel panel-primary container-flued" style="border-radius: 0px;">
            <div class="panel-heading" style="border-radius: 0px;"> <h4>{{number}}-класс</h4> </div>
            <div class="panel-body" style="padding:0px;border-radius: 0px;">
                <p class="alert alert-warning" v-if="errorMessage">
                    {{errorMessage}}
                </p>
                <div class="list-group container-flued" style="border-radius: 0px;" v-for="classe in classes" :key="classe.id_class">
                    <div  class="list-group-item" @click="showingModal=true; getItems(classe.id_class); idActivClass=classe.id_class;" style="border-radius: 0px;">"{{classe.class_name_category}}"-класс</div>
                </div>
            </div>
        </div>



        <!-- Modal -->
        <div  class="modal fade in " role="dialog" style="display: block;" v-if="showingModal">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Предметы</h4>
                    </div>
                    <div class="modal-body">
                        <p class="alert alert-warning" v-if="errorMessageGetItems">
                            {{errorMessageGetItems}}
                        </p>
                        <div class="list-group" v-for="item in items" :key="item.id_item">
                            <a :href="'journal/'+idActivClass+'/'+item.id_item" class="list-group-item">{{item.name}}</a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" v-on:click="showingModal=false; errorMessageGetItems=''; idActivClass=0; ">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ["number"],
        data () {
            return {
                showingModal: false,
                errorMessage: '',
                errorMessageGetItems: '',
                idActivClass:0,
                items: [],
                classes: [],
            }
        },
        mounted() {
            this.getClasses();
        },
        methods: {
            getClasses: function(){
                axios.get("http://school.kg/classes/"+this.number)
                    .then(function(response){
                        if(response.data.error){
                            this.errorMessage = response.data.message; 
                        } else{
                            this.classes = response.data.classes;
                        }
                    }.bind(this));
            },
            getItems: function(id_class){
                axios.get("http://school.kg/items/"+id_class)
                    .then(function(response){
                        if(response.data.error){
                            this.errorMessageGetItems = response.data.message; 
                        } else{
                            this.items = response.data.items;
                        }
                    }.bind(this));
            }

        }
    }
</script>