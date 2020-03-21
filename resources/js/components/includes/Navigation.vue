<template>
    <div>
        <v-navigation-drawer
        v-model="primaryDrawer.model"
        :clipped="primaryDrawer.clipped"
        :floating="primaryDrawer.floating"
        :mini-variant="primaryDrawer.mini"
        :permanent="primaryDrawer.type === 'permanent'"
        :temporary="primaryDrawer.type === 'temporary'"
        app
        overflow
        :expand-on-hover="primaryDrawer.mini"
        >
          <template v-slot:prepend>
          <v-list-item two-line href="profile" active-class="red--text" exact color="grey">
          <v-list-item-avatar>
            <img src="public/images/user.png">
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title>Owner</v-list-item-title> 
            <v-list-item-subtitle>
              Admin
            </v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
      </template>

      <v-divider></v-divider>
      
       <v-list shaped> 

       
           <v-list-item  active-class="highlighted" exact color="grey">
          
            <v-list-item-icon>
              <v-icon>fas fa-tachometer-alt</v-icon>
            </v-list-item-icon>

            <v-list-item-content>
              <v-list-item-title>Dashboard </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
  

           <v-list-item href="pos" active-class="active" exact color="grey">
          
            <v-list-item-icon>
              <v-icon>mdi-cash-register</v-icon>
            </v-list-item-icon>

            <v-list-item-content>
              <v-list-item-title>Make Sales </v-list-item-title>
            </v-list-item-content>
          
          </v-list-item>
       

          <v-list-group
          v-for="item in items"
          :key="item.title"                
          :prepend-icon="item.action"
          no-action   
          active-class="active" exact     
        >
        

          <template v-slot:activator>

            <v-list-item-content>
              <v-list-item-title v-text="item.title" ></v-list-item-title>
            </v-list-item-content>  

          </template>



          <v-list-item 
            v-for="subItem in item.items"
            :key="subItem.title"    
            :href="subItem.link" active-class="active" exact color="grey"      
          >
            <v-list-item-content>
              <v-list-item-title v-text="subItem.title"></v-list-item-title>
            </v-list-item-content>
          </v-list-item>

        </v-list-group>
              
           <v-list-item href="/" active-class="active" exact color="grey" >
          
            <v-list-item-icon>
              <v-icon>fas fa-clipboard</v-icon>
            </v-list-item-icon>

            <v-list-item-content>
              <v-list-item-title>Inventory Report </v-list-item-title>
            </v-list-item-content>
          
          </v-list-item>

           <v-list-item href="/" active-class="active" exact color="grey" >
          
            <v-list-item-icon>
              <v-icon>mdi-cash-refund</v-icon>
            </v-list-item-icon>

            <v-list-item-content>
              <v-list-item-title>Expense Tracker </v-list-item-title>
            </v-list-item-content>
          
          </v-list-item>

           <v-list-item href="/" active-class="active" exact color="grey" >
          
            <v-list-item-icon>
              <v-icon>mdi-account-group</v-icon>
            </v-list-item-icon>

            <v-list-item-content>
              <v-list-item-title>Cutomers </v-list-item-title>
            </v-list-item-content>
          
          </v-list-item>

           <v-list-item href="/" active-class="active" exact color="grey" >
          
            <v-list-item-icon>
              <v-icon>mdi-cog</v-icon>
            </v-list-item-icon>

            <v-list-item-content>
              <v-list-item-title>Settings </v-list-item-title>
            </v-list-item-content>
          
          </v-list-item>
        
      </v-list>

      <v-divider></v-divider>

   

      <template v-slot:append>
        <div class="pa-2">
          <v-btn block dark @click="logout"> <v-icon >mdi-logout</v-icon> Logout </v-btn>
        </div>
      </template>

        </v-navigation-drawer>

        <v-app-bar
        :clipped-left="primaryDrawer.clipped"
        app
        >
        <v-app-bar-nav-icon
            v-if="primaryDrawer.type !== 'permanent'"
            @click.stop="primaryDrawer.mini = !primaryDrawer.mini"
        />
        <v-toolbar-title> Monday 12:52.62</v-toolbar-title>
        </v-app-bar>

    </div>
</template>

<script>
  export default {
       data () {
      return {
       items: [  
  
        {
          action: 'fas fa-cubes',
          title: 'Products', 
          index: 0,        
          items: [           
            { title: 'Categories', link:'categories' },
            { title: 'Products List',link:'products' },
            { title: 'Discount',link:'discounts' },
          ],
        },
        {
          action: 'mdi-account-details',
          title: 'Employees',
          index: 1, 
          items: [
            { title: 'Employee List',link:'' },
            { title: 'Access Rights', link:'' },
          ],
        },
  
 
      ],
      primaryDrawer: {
        model: null,
        type: 'default (no property)',
        clipped: false,
        floating: false,
        mini: false,
      },

      }
     
    },
    methods: {
      logout(){
          window.location.assign('logout');
      }
    }
  }
</script>