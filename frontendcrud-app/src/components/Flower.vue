<template>
    <div class="container">
        <h3 align="center" class="mt-5">Flower Management</h3>
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
            <div class="form-area">
              <form @submit.prevent="save" id="check-register-form">
                 
                    <div class="row">
                        <div class="col-md-6">
                          <label>Flower Name</label>
                          <v-text-field
                          v-model="flower.name"
                          label="Flower Name"
                          required>
                         </v-text-field>
                        </div>

                        <div class="col-md-6">
                            <label>Flower Type</label>
                            <v-text-field
                            v-model="flower.type"
                            label="Flower Type"
                            required>
                           </v-text-field>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Price</label>
                            <v-text-field
                            v-model="flower.price"
                            label="PHP"
                            required>
                           </v-text-field>
                          
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3">

                          <v-btn type="submit" color="success" form="check-register-form">Save</v-btn>


                        </div>
                    </div>
                </form>
            </div>

            <v-table theme="dark">
              <thead>
                <tr>
                  <th class="text-left">
                    Flower ID
                  </th>
                  <th class="text-left">
                    Flower Name
                  </th>

                  <th class="text-left">
                    Type
                  </th>

                  <th class="text-left">
                    Price
                  </th>
                  <th class="text-left">
                    Action
                  </th>


                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="flower in result"
                  :key="flower.id"
                >
                 <td>{{ flower.id }}</td>
                  <td>{{flower.name }}</td>
                  <td>{{ flower.type }}</td>
                  <td>PHP {{ flower.price }}</td>
                  <td>
                  <v-btn type="button" color="info"  @click="edit(flower)">Edit</v-btn>
                          
                          <v-btn type="button" color="danger"  @click="remove(flower)">Delete</v-btn>
                        </td>        
                </tr>
              </tbody>
            </v-table>
            
            </div>
        </div>
    </div>


</template>


<script>



import axios from 'redaxios';



export default {
  name: 'Flower',
  data () {
    return {
      result: {},
      flower:{
                 id: '',
                 name: '',
                 type: '',
                 price: ''


      }
    }
  },
  created() { 
      this.FlowerLoad();
  },
  mounted() {
        console.log("mounted() called.......");
       
    },

  methods: {
    FlowerLoad()
         {
               var page = "http://127.0.0.1:8000/api/flower";
               axios.get(page)
                .then(
                    ({data})=>{
                      console.log(data);
                      this.result = data;
                    }
                );
         },
         
        
         save()
         {
          if(this.flower.id == '')
            {
              this.saveData();
            }
            else
            {
              this.updateData();
            }       

         },
         saveData()
         {
          axios.post("http://127.0.0.1:8000/api/flower", this.flower)
          .then(
            ({data})=>{
              this.FlowerLoad();
               this.flower.name = '';
                this.flower.type = '',
                this.flower.price = ''
                 this.id = ''
            }
          )

         },
         edit(flower)
         {
          this.flower = flower;
         
         },
         updateData()
         {
            var editrecords = 'http://127.0.0.1:8000/api/flower/'+ this.flower.id;
            axios.put(editrecords, this.flower)
            .then(
              ({data})=>{
                this.flower.name = '';
                this.flower.type = '',
                this.flower.price = ''
                this.id = ''
                alert("Flower was Updated");
                this.FlowerLoad();
              }
            );

         },

         remove(flower){

           var url = `http://127.0.0.1:8000/api/flower/${flower.id}`;


            axios.delete(url);
            alert("Flower was Deleted");
            this.FlowerLoad();
          }
    }
}
</script>

<style scoped>
      .form-area{
        padding: 20px;
        margin-top: 20px;
          background: color pink -500px;;
          color: #fffcfc;
      }
      .bi-trash-fill{
        color:rgb(106, 15, 85);
        font-size: 18px;
      }
      .bi-pencil{
        color:rgb(241, 45, 228);
        font-size: 18px;
        margin-left: 20px;
      }



</style>