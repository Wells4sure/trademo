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
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="title">
            <v-list-item-icon>
             <v-icon>mdi-cash-register</v-icon>
             </v-list-item-icon>

          </v-list-item-title>
          <v-list-item-title v-if="!primaryDrawer.mini">
            Tradmo
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-divider></v-divider>
 <v-list>
        <v-subheader>Main Menu</v-subheader>
      <v-list-item inactive="true">
        <v-list-item-icon>
          <v-icon>mdi-home</v-icon>
        </v-list-item-icon>

        <v-list-item-title>Dashboard</v-list-item-title>
      </v-list-item>

      <v-list-group
        v-for="item in items"
        :key="item.title"
        v-model="item.active"
        :prepend-icon="item.action"
        no-action
      >
        <template v-slot:activator>
          <v-list-item-content>
            <v-list-item-title v-text="item.title"></v-list-item-title>
          </v-list-item-content>
        </template>

        <v-list-item
          v-for="subItem in item.items"
          :key="subItem.title"
        >
          <v-list-item-content>
            <v-list-item-title v-text="subItem.title"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>

      </v-list-group>
    </v-list>

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
            action: 'mdi-local_activity',
            title: 'Attractions',
            items: [
              { title: 'List Item' },
            ],
          },
          {
            action: 'mdi-restaurant',
            title: 'Dining',
            active: true,
            items: [
              { title: 'Breakfast & brunch' },
              { title: 'New American' },
              { title: 'Sushi' },
            ],
          },
          {
            action: 'mdi-school',
            title: 'Education',
            items: [
              { title: 'List Item' },
            ],
          },
          {
            action: 'mdi-directions_run',
            title: 'Family',
            items: [
              { title: 'List Item' },
            ],
          },
          {
            action: 'mdi-healing',
            title: 'Health',
            items: [
              { title: 'List Item' },
            ],
          },
          {
            action: 'mdi-content_cut',
            title: 'Office',
            items: [
              { title: 'List Item' },
            ],
          },
          {
            action: 'mdi-local_offer',
            title: 'Promotions',
            items: [
              { title: 'List Item' },
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
  }
</script>