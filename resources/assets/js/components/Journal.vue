<template>
    <div>
        <div class="col-md-12">
            <div class="alert alert-danger" v-if="errorMessage">
                    {{errorMessage}}
            </div>
            <div class="header-less">
                <h3 class="col-md-offset-5 col-md-2 ">{{nameItem}}</h3>
                <!-- <div class="wrap-time col-md-offset-4  col-md-2">
                    <h4>Время до конца урока: 25:25</h4>
                </div> -->
            </div>
            <div class="wrappers-journal">
                <div class="pupil-list journal-section">
                        <div class="header item">ФИО</div>
                        <div class="item"></div>
                        <div class="item" v-for="(pupil,id) in pupilList" :key="pupil.id_pupil">
                            <div class="id">{{id+1}}</div>
                            <div class="fio">{{pupil.fio_pupil}}</div>
                        </div>
                </div>

                <div class="assesments journal-section">
                    <div class="month" v-for="(value, key) in lessons" :key="key">
                        <div class="item month-header" >
                            {{
                                month[key-1]
                            }}
                        </div>
                        <div class="lessons">
                            <div class="lesson" v-for="(value,keyLess) in value" :key="keyLess">
                                
                                <div class="item lesson-day">{{value.day}}</div>
                                <!-- {{value}} -->
                                <div class="item osenka" v-for="(pupil,index) in pupilList" :key="pupil.id_pupil">
                                        <div v-if="lessons[key][keyLess]['currentLesson']">
                                            {{hiddenBtnAddLesson()}}
                                            <p v-if="lessons[key][keyLess]['data'][index]" >
                                                {{setActivLesson(index,lessons[key][keyLess]['data'][index])}}
                                            </p>
                                            <input type="text" :name="pupil.id_pupil" :id="index" v-model="assessLess[index]"   @change="sendAssess($event)"    @input="handlerInput($event)">
                                        </div>
                                        <div v-else>
                                            <p v-if="lessons[key][keyLess]['data'][index]">
                                                {{lessons[key][keyLess]['data'][index]}}
                                            </p>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn" v-if="showingBtnAddLesson" @click="showingAddModal=true">+</button>
                </div>

                <div class="plan journal-section">
                    <div class="item">
                        <div class="date"></div>
                        <div class="desc">План</div>
                    </div>
                    <div class="item" v-for="plan in plans" :key="plan.id_lesson">
                        <div class="date">{{plan.date}}</div>
                        <div class="desc">{{plan.plan}}</div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Modal -->
        <div  class="modal fade in " role="dialog" style="display: block;" v-if="showingAddModal" >
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Начать урок</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fio">План урока</label>
                            <input type="text" class="form-control"  v-model="dataForAddLesson.plan">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-default" @click="showingAddModal = false; createLesson()"> Добавить</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" v-on:click="showingAddModal=false">Отмена</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ["className","idItem"],
        data () {
            return {
                showingAddModal: false,
                showingBtnAddLesson:true,
                month:["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сетябрь","Октябрь","Ноябрь","Декабрь"],
                errorMessage:'',
                nameItem:'',
                pupilList:[],
                lessons:[],
                plans:[],
                assessLess:{},
                dataForAddLesson:{plan:""},
                idActivLesson:0,

                obljectSend:{id_pupil:'', assess:'', attendance:''}
            }
        },
        mounted() {
            console.log('mounted journal');
            this.getNameItem();
            this.getAllPupil();
            this.getLessons();
            this.getPlan();
            
        },
        methods: {
            getAllPupil: function(){
                console.log('function getAllPupil');
                console.log(this.className);
                axios.get("http://school.kg/admin/pupils/ajax/"+this.className)
                .then(function(response){
                    console.log(response);
                    if(response.data.error){
                        this.errorMessage = response.data.message; 
                    } else{
                        this.pupilList = response.data.pupils;
                    }
                }.bind(this));
            },
            getLessons:function(){
                console.log("getLessons");
                axios.get("http://school.kg/journal/lessons/ajax/"+this.className+"/"+this.idItem)
                .then(function(response){
                    console.log(response);
                    if(response.data.error){
                        this.errorMessage = response.data.message; 
                    } else{
                        this.lessons = response.data.data;
                    }
                }.bind(this));
            },
            getPlan:function(){
                console.log("getPlan()");
                axios.get("http://school.kg/journal/plan/ajax/"+this.className+"/"+this.idItem)
                .then(function(response){
                    console.log(response);
                    if(response.data.error){
                        this.errorMessage = response.data.message; 
                    } else{
                        this.plans = response.data.data;
                    }
                }.bind(this));
            },
            createLesson:function(){
                console.log("createLesson()");
                var form_data=this.toFormData(this.dataForAddLesson);
                axios.post("http://school.kg/journal/create-lesson/ajax/"+this.className+"/"+this.idItem, form_data)
                .then(function(response){
                    console.log(response);
                    if(response.data.error){
                        this.errorMessage = response.data.message; 
                    } else{
                        this.idActivLesson = response.data.id;
                        this.getLessons();
                        this.getPlan();
                    }
                }.bind(this));
            },
            setActivLesson:function(key, value){
                // console.log("setActivLesson");
                // console.log("key:"+key+"   value:"+value);
                this.assessLess[key]=value;
                this.showingBtnAddLesson=false;
            },
            toFormData: function(obj){
                var form_data = new FormData();
                for ( var key in obj ) {
                    form_data.append(key, obj[key]);
                } 
                return form_data;
            },
            handlerInput:function(event){
                var value=event.target.value;
                var index=event.target.id;
                if(isFinite(value)){
                    value=parseInt(value);
                    if(0<=value&&value < 6){
                        this.assessLess[index]=value;
                    }
                    else{
                        this.assessLess[index]='';
                    }
                }
                else if(value==='н' || value==='нб'){
                    this.assessLess[index]=value;
                }
                else{
                    this.assessLess[index]='';
                }
            },
            sendAssess:function(event){
                this.obljectSend={id_pupil:'', assess:'', attendance:''}
                var value=event.target.value;
                var id=event.target.name;
                console.log("sendAssess");
                if(isFinite(value)){
                    value=parseInt(value);
                    if(0<=value&&value < 6){
                        this.obljectSend.id_pupil=id;
                        this.obljectSend.assess=value;
                    }
                }
                else if(value==='нб'){
                    this.obljectSend.id_pupil=id;
                    this.obljectSend.attendance=value;
                }
                //console.log(this.obljectSend.id_pupil !== '')
                if(this.obljectSend.id_pupil !== ''){
                    var form_data=this.toFormData(this.obljectSend);
                    axios.post("http://school.kg/journal/add-assess/ajax/"+this.className+"/"+this.idItem, form_data)
                    .then(function(response){
                        //console.log("sendAssess");
                        //console.log(response);
                        if(response.data.error){
                            this.errorMessage = response.data.message; 
                        } else{
                            this.idActivLesson = response.data.id;
                        }
                    }.bind(this));
                }
            },
            getNameItem:function(){
                console.log("getNameItem");
                axios.get("http://school.kg/journal/name-item/ajax/"+this.className+"/"+this.idItem)
                .then(function(response){
                    // console.log("getNameItem");
                    // console.log(response);
                    if(response.data.error){
                        this.errorMessage = response.data.message; 
                    } else{
                        this.nameItem = response.data.nameItem;
                    }
                }.bind(this));
            },
            hiddenBtnAddLesson:function(){
                this.showingBtnAddLesson=false;
            }
        }
    }
</script>
