<template>
 <v-app>
<!-- load Navigation -->
  <navbar-comp/>

    <v-content>
      <v-container fluid>
        <v-row
          align="center"
          justify="center"
        >
          <v-col cols="12" elevate="7">
            <v-card>
              <v-card-text>
                <v-row>

                  <v-col cols="6"  md="3" >
                     <v-card
                      class="mx-auto"
                      max-width="344"
                      elevation="7"
                    >
                        <v-list-item three-line>
                        <v-list-item-content>
                        
                          <v-list-item-title class="headline mb-1">120,000.00</v-list-item-title>
                          <v-list-item-subtitle>Todays Sales</v-list-item-subtitle>
                        </v-list-item-content>

                        <v-list-item-avatar
                          tile
                          size="80"
                          color="green"
                        >
                        <v-icon>mdi-arrow-up</v-icon>
                        </v-list-item-avatar>
                      </v-list-item>
                    </v-card>

                  </v-col>
                  <v-col cols="6"  md="3" >

                     <v-card
                      class="mx-auto"
                      max-width="344"
                      elevation="7"
                    >
                        <v-list-item three-line>
                        <v-list-item-content>
                        
                          <v-list-item-title class="headline mb-1">1200</v-list-item-title>
                          <v-list-item-subtitle>Todays Transaction</v-list-item-subtitle>
                        </v-list-item-content>

                        <v-list-item-avatar
                          tile
                          size="80"
                          color="green"
                        >
                        <v-icon>mdi-arrow-up</v-icon>
                        </v-list-item-avatar>
                      </v-list-item>
                    </v-card>

                  </v-col>
                  <v-col cols="6"  md="3" >

                     <v-card
                      class="mx-auto"
                      max-width="344"
                      elevation="7"
                    >
                        <v-list-item three-line>
                        <v-list-item-content>
                        
                          <v-list-item-title class="headline mb-1">10,000.00</v-list-item-title>
                          <v-list-item-subtitle>Monthly Sales</v-list-item-subtitle>
                        </v-list-item-content>

                        <v-list-item-avatar
                          tile
                          size="80"
                          color="red"
                        >
                        <v-icon>mdi-arrow-down</v-icon>
                        </v-list-item-avatar>
                      </v-list-item>
                    </v-card>

                  </v-col>
                  <v-col cols="6"  md="3" >

                     <v-card
                      class="mx-auto"
                      max-width="344"
                      elevation="7"
                    >
                        <v-list-item three-line>
                        <v-list-item-content>
                        
                          <v-list-item-title class="headline mb-1">120</v-list-item-title>
                          <v-list-item-subtitle>Monthly Transactions</v-list-item-subtitle>
                        </v-list-item-content>

                        <v-list-item-avatar
                          tile
                          size="80"
                          color="red"
                        >
                        <v-icon>mdi-arrow-down</v-icon>
                        </v-list-item-avatar>
                      </v-list-item>
                    </v-card>

                  </v-col>
  <v-divider></v-divider>
                  <v-col cols="12"  md="12" mt="n10">
                    <v-card elevation="0">
                       <h3>Total Monthly Sales</h3>
                       <v-sparkline
                        :labels="labels"
                        :value="value"
                        color="white"
                        line-width="2"
                      
                    
                      ></v-sparkline>
                    </v-card>
                  </v-col>
                </v-row>

              </v-card-text>
      
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-content>

  <!-- Load Footer -->
  <footer-comp/>

</v-app>
</template>

<script>

  export default {
     data: () => ({
        labels: [
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'May',
        'Jun',
        'Jul',
        'Aug',
      ],
      value: [
        200,
        675,
        410,
        390,
        310,
        460,
        250,
        240,
      ],
    }),
  }
</script>