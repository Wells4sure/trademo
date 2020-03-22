<template>
  <v-app>
<!-- load Navigation -->
  <navbar-comp/>

    <v-content>
      <v-container fluid>
           <v-row>
            <v-col cols="12">
                  <v-card>
                    <v-card-title>
                        Categories
                        
                        <v-spacer></v-spacer>
     
                      <v-btn class="blue white--text"  @click.stop="dialog = true">
                        <v-icon left>mdi-plus</v-icon>
                        Add Category
                      </v-btn>

                        
                    </v-card-title> 

                    <v-container>
                    <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Search"
                    single-line
                    hide-details
                  ></v-text-field>
                   <v-data-table
                    :headers="headers"
                    :items="categories"
                    :search="search"                    
                    no-data-text="No Categories Available"
                    :sort-by="name"
                  >
                <template v-slot:item="{item, on, attrs }">
                  <tr class="my-4">
                    <td>
                      {{item.name}}
                    </td>                    
                    <td>
                      <v-avatar :color="item.color" size="45">
                        <span class="white--text " > {{item.name.charAt(0).toUpperCase()}}</span>
                       
                      </v-avatar>
                    
                      
                    </td>
                    <td>
                       <v-btn class="mx-2" outlined fab dark small color="red"  v-bind="attrs"
                        v-on="on" @click="deleteCategory(item.id)">
                          <v-icon dark>mdi-delete</v-icon>
                        </v-btn>
              
                    </td>
                  </tr>

                </template>

                  </v-data-table>  
                  </v-container>

                  </v-card>
             
            </v-col>
      <v-dialog
      v-model="dialog"
      persistent 
      max-width="620px"
      >
      <v-card>
        <v-card-title class="headline">Add Category</v-card-title>

        <v-card-text>
           <v-container>
            <v-row>
                      <v-alert
                        v-model="alert"
                        dismissible
                        type="error"
                        border="left"
                        elevation="2"
                        colored-border
                        icon="mdi-alert"
                        width="100%"
                          v-if="validationErrors"    
                      >
                        <strong>Whoops! </strong>{{validationErrors}}.
                      </v-alert>
               
                <v-col cols="12">
                <v-text-field label="Category Name *" v-model="$v.name.$model" required
                :error-messages="$v.name.$dirty && !$v.name.required ? ['This field is required'] :[]"
                ></v-text-field>
              </v-col>                
              <v-col cols="12">
                <v-radio-group v-model=" $v.categoryColor.$model" row  :error-messages="$v.categoryColor.$dirty && !$v.categoryColor.required ? ['This field is required'] :[]">
                    <v-radio label="Default"   color="#4e4e4e" value="#4e4e4e"></v-radio>
                    <v-radio label="Blue"   color="primary " value="#1867C0"></v-radio>
                    <v-radio label="Green"   color="success " value="#4CAF50"></v-radio>
                    <v-radio label="Orange"   color="#F44336 " value="#F44336"></v-radio>
                    <v-radio label="Purple"   color="#9C27B0 " value="#9C27B0"></v-radio>
                    <v-radio label="Red"   color="#E91E63 " value="#E91E63"></v-radio>
                  
                </v-radio-group>
              </v-col>
              <v-col cols="12" v-if="submitStatus === 'PENDING'">
                <v-progress-linear
                  color="green accent-4"
                  indeterminate
                  rounded
                  height="6"
                ></v-progress-linear>
          </v-col>
            </v-row>
           </v-container>
        </v-card-text>
            
        <v-card-actions class="px-5">

          <v-btn outlined color="red darken-1" 
            @click="dialog = false"
          >
           <v-icon>mdi-close</v-icon>
            Cancel
          </v-btn>

        <v-spacer></v-spacer>
        
          <v-btn outlined color="green darken-1"          
            @click="addCategory"
          >
           <v-icon>mdi-content-save</v-icon>
            Save
          </v-btn>
       
        </v-card-actions>
      </v-card>
    </v-dialog>

           </v-row>
      </v-container>
    </v-content>

  <!-- Load Footer -->
  <footer-comp/>

  </v-app>
</template>

<script>
import Errors from '../class/Errors.js';
import { required, minLength } from 'vuelidate/lib/validators'
export default {
  data () {
      return {
        search: '',
        headers: [
          {
            text: 'Name',
            align: 'start',
            value: 'name',
          },
          { text: 'Color', value: 'color' },
          { text: 'Action', value: 'attrs' },
        ],
        dialog: false,
        name:'',
        categoryColor:'#4e4e4e',
        validationErrors:'',
        submitStatus:''
      }
    },
    methods:{
        addCategory(){
          this.$v.$touch()
          if (this.$v.$invalid) {
             this.submitStatus = 'ERROR'
          }else{

            this.submitStatus = 'PENDING'

            let data = new FormData();
              data.append('create', 1);
              data.append('name', this.name);
              data.append('color', this.categoryColor);

              axios.post( 'app/controller/products/categories.php', data)
              .then((res)=>{
                  if(res.data.error ==false){

                      izitoast.success({
                          title: 'Success:',
                          message:res.data.message,
                          position: 'topCenter'
                      });
                    this.submitStatus =  null;
                    this.dialog = false;
                    this.name=''
                  this.$store.dispatch("allCategories");
                  }else{
                   this.validationErrors=res.data.message
                   this.submitStatus = null
                }

              })

          }
        },
        deleteCategory(id){
          let category_id =id;
          let data = new FormData();
          data.append('delete', 1);
          data.append('category_id', category_id);
          
          axios.post( 'app/controller/products/categories.php', data)
          .then(res => {

            izitoast.success({
                  title: 'Success:',
                  message:res.data.message,
                  position: 'topCenter'
            });

            this.$store.dispatch("allCategories");

          }).catch(err =>{

            izitoast.error({
                  title: 'Error:',
                  message:"System Failed Please Try again Later",
                  position: 'topCenter'
            });
            
          });  
        }
    
    },
    mounted() {
        this.$store.dispatch("allCategories");
    },
    computed : {
      categories(){ //final output from here
          return this.$store.getters.getCategoriesFormGetters 
      }
    },
     validations: {
      name:{
        required,
      },
      categoryColor: {
      required,
    },
  }
}
</script>

<style>

</style>