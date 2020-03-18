<template>
    <v-content>
        <v-container class="fill-height"  fluid >
             <v-row  align="center"   justify="center">
                    <v-col  cols="12" sm="8"  md="4">
                         <v-card class="elevation-5">
                            <v-row class="my-row">
                               <v-col cols="12"  class="left-side">
                                    <v-card-text>
                                        <v-alert
                                        v-model="alert"
                                        dismissible
                                        type="error"
                                        border="left"
                                        elevation="2"
                                        colored-border
                                        icon="mdi-alert"
                                        v-if="validationErrors"                              
                                        >
                                        <strong>Whoops! </strong> {{ validationErrors}}
                                        
                                        </v-alert>
                                      <v-col cols="12"  v-if="!inst"  >
                                          <h3>Installing...</h3>
                                          <p>Wait a minute we setup your system</p>
                                          
                                              <v-progress-linear
                                                  color="blue accent-4"
                                                  indeterminate
                                                  rounded
                                                  height="6"
                                              ></v-progress-linear>
                                      
                                      </v-col>
                                      <v-form  @keyup.native.enter="submit($event)" v-else>
                                         <h3>Quick Setup</h3>
                                        <v-card-text>Create Your Free account by filling the form below to register.</v-card-text>
                                         <v-text-field                                        
                                            v-model="$v.email.$model"
                                            label="Email address"  
                                            name="login"  
                                            prepend-icon="mdi-account"  
                                            type="text" 
                                            clearable                                          
                                            dark
                                            color="blue"                                        
                                            :error-messages="$v.email.$dirty && !$v.email.required ? ['This field is required'] : !$v.email.email ? ['Must be a valid email'] :  []">
                                         </v-text-field>
                                        <v-text-field  
                                        v-model="$v.password.$model"
                                        :class="{ 'form-group--error': $v.password.$error }"
                                        id="password"  
                                        label="Password"  
                                        name="password"  
                                        prepend-icon="mdi-lock" 
                                        type="password"                                       
                                        dark
                                        color="blue"  
                                        :error-messages="$v.password.$dirty && !$v.password.required ? ['This field is required'] :!$v.password.minLength ? ['Password must have at least 6 letters.'] : []"
                                        clearable ></v-text-field>
                                        <v-text-field                                         
                                          v-model="$v.business.$model" 
                                          id="business"  
                                          name="business"                                         
                                          :error-messages="$v.business.$dirty && !$v.business.required ? ['This field is required'] :[]"
                                          label="Business Name"  
                                          prepend-icon="mdi-office-building"                                         
                                          dark
                                          color="blue"  
                                          clearable
                                          required
                                        ></v-text-field>
                      
                                         <v-checkbox
                                          v-model="$v.terms.$model"                                                                        
                                          :error-messages="$v.terms.$dirty && !$v.terms.required ? ['This field is required'] :[]"
                                          dark
                                          mandatory
                                        >
                                        <template v-slot:label>
                                            <div>
                                              I understand and agree to Trademo
                                              <v-tooltip bottom>
                                                <template v-slot:activator="{ on }">
                                                  <a
                                                    target="_blank"
                                                    href="termsofuse"
                                                    @click.stop
                                                    v-on="on"
                                                    class="linktext"
                                                     color="blue lighten-4"    
                                                  >
                                                    Term of Use
                                                  </a>
                                                </template>
                                                Read our Terms of use
                                              </v-tooltip>
                                             and 
                                              <v-tooltip bottom>
                                                <template v-slot:activator="{ on }">
                                                  <a
                                                    target="_blank"
                                                    href="termsofuse"
                                                    @click.stop
                                                    v-on="on"
                                                    class="linktext"
                                                     color="blue lighten-4"  
                                                  >
                                                    Privacy Policy
                                                  </a>
                                                </template>
                                                Read our Privacy Policy
                                              </v-tooltip>
                                            </div>
                                          </template>
                                        </v-checkbox>
                                    </v-form>
                                    <v-btn large color="success"  :disabled="submitStatus === 'PENDING' || terms ===false" @click="submit" block>Sign up</v-btn>
                                         
       
                                      <v-col cols="12" v-if="submitStatus === 'PENDING'">
                                      <v-progress-linear
                                        color="green accent-4"
                                        indeterminate
                                        rounded
                                        height="6"
                                      ></v-progress-linear>
                                    </v-col>
                                    </v-card-text>

                               </v-col>
                            </v-row>
                         </v-card>
                    </v-col>
             </v-row>
        </v-container>
    </v-content>
</template>
<script>
import Errors from '../class/Errors.js';
import { required, minLength, email } from 'vuelidate/lib/validators'
export default {
    name:'install',
  
  data() {
    return {
        alert: true,
        inst: false,
        submitStatus: null,
        terms: false,
        email: '',
        password:'',
        business:'',
        country:'',
        login_error: new Errors(),
        validationErrors:'',
      
    }
  },
  mounted(){
      axios.get('app/controller/installer/setup.php')  
      .then(res => {
        if(res.data.error==false){
          this.inst=true;
        }
      })
  },

  methods:{
    submit(){
       this.$v.$touch()
      if (this.$v.$invalid) {
          this.submitStatus = 'ERROR'
          this.validationErrors="Please fill the form correctly"
        }else{
        // do your submit logic here
          this.submitStatus = 'PENDING'
          if(this.terms){
             let data = new FormData();

              data.append('email', this.email);
              data.append('password', this.password);
              data.append('business', this.business);
              data.append('role', 'owner');

             axios.post('app/controller/auth/register.php', data)
             .then(response => {
                this.submitStatus = 'OK'
                //  window.location.assign('home');
             }).catch(error => {
                
               this.login_error.record(error.response.data.errors)
               if (this.login_error.any()) {
                    Object.keys(this.login_error.errors).forEach(error => {

                      this.validationErrors=this.login_error.errors[error][0];
                      
                    });
                }
                this.submitStatus = null
             })
           
          }
        }
    }
  },
  validations: {
     email:{
            required,
            email
      },
      password: {
      required,
      minLength: minLength(6)
    },
      business: {
      required,
    },
      terms: {
      required,
    },
  }
}
</script>
<style lang="scss" scoped>
.btn-link:hover {
    color: rgb(22, 116, 149);
    background-color: transparent;
}
.my-text-style input {
    color: red !important;
  }
.my-row{
    margin-left: 0px;
    margin-right: 0px;
    border-radius: .25rem;
}
.right-side{
    text-align: center;
    color: #fff;
    background: #20A8D8;

}
.left-side{
    background: #3A4149;
    color: #fff;
    border: 1px solid #23282c;
    
}
.container.fill-height {
    background: #2F353A;
}
.link-btn{
    text-decoration: none;
}

.typo__p{
  color: red;
}
</style>