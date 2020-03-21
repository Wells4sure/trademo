<template>
  <v-app>
<!-- load Navigation -->
  <navbar-comp/>

    <v-content>
      <v-container fluid>
           <v-row>
            <v-col cols="12">
                  <v-card>
                    <v-card-text>
                      <v-btn class="blue white--text" absolute right  @click.stop="dialog = true">
                        <v-icon left>mdi-plus</v-icon>
                        Add Category
                      </v-btn>
                        <h1>Categories</h1>
                        <small>Help Text:</small>
                    </v-card-text> 
                  
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
                <v-col cols="12">
                <v-text-field label="Name*" v-model="name" required></v-text-field>
              </v-col>                
              <v-col cols="12">
                <v-radio-group v-model="categoryColor" row>
                    <v-radio label="Default"   color="default" value="#4e4e4e"></v-radio>
                    <v-radio label="Blue"   color="primary " value="#1867C0"></v-radio>
                    <v-radio label="Green"   color="success " value="#4CAF50"></v-radio>
                    <v-radio label="Orange"   color="#F44336 " value="#F44336"></v-radio>
                    <v-radio label="Purple"   color="#9C27B0 " value="#9C27B0"></v-radio>
                    <v-radio label="red"   color="#E91E63 " value="#E91E63"></v-radio>
                  
                </v-radio-group>
              </v-col>
            </v-row>
           </v-container>
        </v-card-text>

        <v-card-actions>
      <v-container>

          <v-btn
            outlined
            color="red darken-1"
            text
            @click="dialog = false"
          >
           <v-icon>mdi-close</v-icon>
            Cancel
          </v-btn>
        <v-spacer></v-spacer>
          <v-btn
          outlined
            color="green darken-1"
            text
            @click="addCategory"
          >
           <v-icon>mdi-content-save</v-icon>
            Save
          </v-btn>
      </v-container>
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
export default {
  data () {
      return {
        dialog: false,
        name:'',
        categoryColor:'#4e4e4e',
      }
    },
    methods:{
        addCategory(){
              axios.post( 'api/edit/stations', {

              })
        }
    },
}
</script>

<style>

</style>