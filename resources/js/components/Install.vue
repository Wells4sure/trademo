<template>
    <v-content>
        <v-container class="fill-height"  fluid >
             <v-row  align="center"   justify="center">
                    <v-col  cols="12" sm="8"  md="5">
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

                                        <h3>Installing...</h3>
                                        <p>Wait a minute we setup your system</p>
                                        
                                            <v-progress-linear
                                                color="blue accent-4"
                                                indeterminate
                                                rounded
                                                height="6"
                                            ></v-progress-linear>
                                       <v-card-text>Create Your Free account by filling the form below to register.</v-card-text>
                                    <v-form  @keyup.native.enter="submit($event)" >
                                         <v-text-field                                        
                                            v-model="$v.email.$model"
                                            label="Email address"  
                                            name="login"  
                                            prepend-icon="mdi-account"  
                                            type="text" 
                                            clearable                                          
                                            dark
                                            color="indigo darken-4"                                        
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
                                        color="indigo darken-4"  
                                        :error-messages="$v.password.$dirty && !$v.password.required ? ['This field is required'] :!$v.password.minLength ? ['Password must have at least 8 letters.'] : []"
                                        clearable ></v-text-field>
                                        <v-text-field                                         
                                          v-model="$v.business.$model" 
                                          id="business"  
                                          name="business"                                         
                                          :error-messages="$v.business.$dirty && !$v.business.required ? ['This field is required'] :[]"
                                          label="Business Name"  
                                          prepend-icon="mdi-office-building"                                         
                                          dark
                                          color="indigo darken-4"  
                                          clearable
                                          required
                                        ></v-text-field>
                                        <v-autocomplete                                         
                                          v-model="$v.country.$model"                                        
                                          :items="countries"
                                          :error-messages="$v.country.$dirty && !$v.country.required ? ['This field is required'] :[]"
                                          label="Country"
                                          id="Country"  
                                          name="country"  
                                          prepend-icon="mdi-earth"
                                          dark
                                          clearable  
                                          required
                                          item-text="name"
                                          item-value="id"
                                          color="indigo darken-4"  
                                          return-object
                                        ></v-autocomplete>
                                         <v-checkbox
                                          v-model="$v.terms.$model"                                                                        
                                          :error-messages="$v.terms.$dirty && !$v.terms.required ? ['This field is required'] :[]"
                                          dark
                                          mandatory
                                        >
                                        <template v-slot:label>
                                            <div>
                                              I understand and agree to Opoint
                                              <v-tooltip bottom>
                                                <template v-slot:activator="{ on }">
                                                  <a
                                                    target="_blank"
                                                    href="/termsofuse"
                                                    @click.stop
                                                    v-on="on"
                                                    class="linktext"
                                                  >
                                                    Term of Use
                                                  </a>
                                                </template>
                                                See Terms of use
                                              </v-tooltip>
                                             and 
                                              <v-tooltip bottom>
                                                <template v-slot:activator="{ on }">
                                                  <a
                                                    target="_blank"
                                                    href="/termsofuse"
                                                    @click.stop
                                                    v-on="on"
                                                    class="linktext"
                                                  >
                                                    Privacy Policy
                                                  </a>
                                                </template>
                                                See Privacy Policy
                                              </v-tooltip>
                                            </div>
                                          </template>
                                        </v-checkbox>
                                    </v-form>
                                    <v-btn large color="success"  :disabled="submitStatus === 'PENDING' || terms ===false" @click="submit" block>Sign up</v-btn>
                                    <p class="typo__p" v-if="submitStatus === 'OK'">Thanks for your submission!</p>
                                    <p class="typo__p" v-if="submitStatus === 'ERROR'">Please fill the form correctly.</p>
                                    <p class="typo__p" v-if="submitStatus === 'PENDING'">Sending...</p>
                                      <a href="/login" class="link-btn" ><v-btn text dark class="mt-5"> Already have an account? Sign in </v-btn></a>
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
    props:['countries'],
  data() {
    return {
        alert: true,
        submitStatus: null,
        terms: false,
        email: '',
        password:'',
        business:'',
        country:'',
        login_error: new Errors(),
        validationErrors:'',
        errorMessages: '',
    }
  },
  validations: {
     email:{
            required,
            email
      },
      password: {
      required,
      minLength: minLength(8)
    },
      business: {
      required,
    },
      country: {
      required,
    },
      terms: {
      required,
    },
  }
}
</script>
<style scoped>
.container.fill-height {
    background: #2F353A;
}
.link-btn{
    text-decoration: none;
}
.left-side{
    background: #3A4149;
    color: #fff;
    border: 1px solid #23282c;
    
}
</style>