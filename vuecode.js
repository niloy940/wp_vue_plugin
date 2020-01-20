Vue.component('calc', {
    template: `
    <div>
        Quantity :
        <input type="number" v-model="quantity" class="width:10px;" @keyup="calclulation">
        x € {{ price }} + {{ free }} Gratis = € {{ total }}
    </div>
    `,

    data() {
        return {
            quantity: 100,
            price: 0.69,
            total: 69,
            free: 50,
        }
  },

  methods: {
      calclulation() {
        if (this.quantity >= 100 && this.quantity <= 249) {
            this.price = 0.69;
        } else if(this.quantity >= 250 && this.quantity <= 499) {
            this.price = 0.59;
        } else if(this.quantity >= 500 && this.quantity <= 999) {
            this.price = 0.55;
        } else if(this.quantity >= 1000) {
            this.price = 0.49;
        } else {
            this.price = 0.69;
        }

        this.free = this.quantity / 2;

        this.total = this.quantity * this.price;
      }
  },
});



Vue.component('tabs', {
    template: `
        <div style="border: 1px solid green; padding:3px;">
            <div class="tabs is-centered is-boxed is-medium">
              <ul>
                <li v-for="tab in tabs" :class="{ 'is-active' : tab.isActive }">
                  <a :href="tab.href" @click="selectTab(tab)">
                    <span class="icon is-small"><i :class="tab.showIcon" aria-hidden="true"></i></span>
                    <span>{{tab.name}}</span>
                  </a>
                </li>
              </ul>
            </div>

            <div class="tab-details">
                <slot></slot>
            </div>
        </div>
    `,

    data() {
        return{
            tabs: []
        };
    },

    created() {
        this.tabs = this.$children;
    },

    methods: {
        selectTab(selectedTab) {
            this.tabs.forEach(tab => {
                tab.isActive = (tab.name  == selectedTab.name);
            });
        }
    }
});

Vue.component('tab', {
    template:`
        <div v-show="isActive">
            <slot></slot>
        </div>
    `,

    props: {
        name: {required: true},
        selected: {default: false},
    },

    data() {
        return {
            isActive: false,
            showIcon: true,
            row_three: 'some text'
        };
    },

    computed: {
        href() {
            return '#' + this.name.toLowerCase().replace(/ /g, '-');
        }
    },

    mounted() {
        this.isActive = this.selected;

        if (this.href.includes('picture')) {
            return this.showIcon = 'fas fa-image';
        } else if (this.href.includes('music')) {
            return this.showIcon = 'fas fa-music';
        } else if (this.href.includes('video')) {
            return this.showIcon = 'fas fa-film'
        } else if (this.href.includes('document')) {
            return this.showIcon = 'far fa-file-alt'
        } else {
            return this.showIcon = 'fas fa-infinity'
        }
    }
});


Vue.component('modal', {
    template: `
        <div class="modal is-active">
            <div class="modal-background"></div>
            <div class="modal-card">
            <header class="modal-card-head">
              <button @click="$emit('close')" class="delete" aria-label="close"></button>
            </header>

            <section class="modal-card-body">
                <div class="box">
                    <slot></slot>
                </div>
            </section>
          <div>
        </div>
    `,
});


/*Vue.component('imagecom', {
  template: `
    <div>
        <img src="<?php echo plugin_dir_url(__FILE__). '/assets/images/pen.jpeg'; ?>">
    </div>
  `
})*/



new Vue({
  el: '#divWpVue',

  data: {
        showModal: false,
        row_three: '',
    }
});
