<template>
   <v-app id="inspire">
         <v-content>
                <v-container class="fill-height"  fluid >
                    <v-row  align="center"   justify="center">
                        <v-col  cols="12" sm="8"  md="6">
                      
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
                           
                    
                      
                           <v-card class="elevation-5">
                      
                               <v-row class="my-row">
                               <v-col cols="6" sm="12"  md="6" class="left-side">
                                
                           
                                
                                <v-card-text>
                                    <h3>Login</h3>
                                    Sign In to your account
                                     <v-form  @keyup.native.enter="submit($event)" action="post" >
                                         <v-text-field                                        
                                            v-model="$v.email.$model"
                                            label="Email address"  
                                            name="login"  
                                            prepend-icon="mdi-account"  
                                            type="text" 
                                            clearable 
                                            color="blue"
                                            dark    
                                            autofocus                                    
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
                                        color="blue"
                                        dark
                                        :error-messages="$v.password.$dirty && !$v.password.required ? ['This field is required'] :  []"
                                        clearable ></v-text-field>
                                     </v-form>
                                    <v-card-actions class="text-center">
                                        <v-btn large color="#20A8D8" class="white--text" :disabled="submitStatus === 'PENDING'" @click="submit" >Login</v-btn>
                                    
                                        <v-btn text dark large aling-right> Forgot password? </v-btn>
                                     
                                    </v-card-actions>
                                </v-card-text>
                                </v-col>
                                 <v-col cols="6" sm="12"  md="6" class="text-center right-side">
                                    <v-card-title > Sign up</v-card-title>
                                    <v-card-text>Create your account and see you sales grow in an instant</v-card-text>
                                    <a href="register.php" class="link-btn"><v-btn large color="success">Register Now!</v-btn></a>
                                </v-col>

                                </v-row> 
                           </v-card>
                        </v-col>
                    </v-row>
                </v-container>
         </v-content>
   </v-app>
</template>
<script>
import Errors from '../class/Errors.js';
import { required, minLength, email } from 'vuelidate/lib/validators'
export default {
  name:'login',
  data() {
        return {
           submitStatus: null,
            email: '',
            password:'',
            errorMessages: '',
            validationErrors: '',
            login_error: new Errors(),
            alert: true,
        }
    },
      computed: {
    form () {
      return {
        email: this.email,
        password: this.password,
      }
    },
  },
 watch: {
    name () {
      this.errorMessages = ''
    },
  },
  methods: {
      submit () {
      this.validationErrors='';
      this.$v.$touch()
      if (this.$v.$invalid) {
          this.submitStatus = 'ERROR'
        }else{
           // do your submit logic here
          this.submitStatus = 'PENDING'
          let data = new FormData();
          data.append('email', this.email);
          data.append('password', this.password);
          axios.post('/login', data)
             .then(response => {
                 window.location.assign('/home');
             }).catch(error => {
               
               this.submitStatus = null
               this.login_error.record(error.response.data.errors)
               
               if (this.login_error.any()) {
                    Object.keys(this.login_error.errors).forEach(error => {
                      this.validationErrors=this.login_error.errors[error][0];
                      
                    });
                }
   
            })
        }
    },
  },
  validations: {
      email:{
            required,
            email
      },
      password: {
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
</style>