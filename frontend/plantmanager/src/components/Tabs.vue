<template> 
        <div class="tabs">
            <ul class='tabs__header'>
                <li v-for="tab in tabs" 
					:class="{ 'is-active': tab.isActive }"
					:key='tab.name'>
                    <a :href="tab.href" @click="selectTab(tab)">{{ tab.name }}</a>
                </li>
            </ul>
           
            <div class="tabs-details">
                <slot></slot>
            </div>
        </div>
</template>

<script>
export default {
  data() {
        return {tabs: [] };
    },
	created() {
        
        this.tabs = this.$children;
        
    },
    methods: {
        selectTab(selectedTab) {
            this.tabs.forEach(tab => {
                tab.isActive = (tab.name == selectedTab.name);
            });
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.tabs__header {
    display: block;
    list-style: none;
    margin: 0 0 0 20px;
    padding: 0;
}

.tabs__header > li {
    padding: 15px 30px;
    border-radius: 10px;
    margin: 0;
    display: inline-block;
    margin-right: 5px;
    cursor: pointer;

    background-color: #ddd;
    color: #aaa;
}

.tabs__header > .is-active {
    font-weight: bold;
    border-radius: 10px 10px 0 0;
    border-bottom: 8px solid transparent;

    background-color: #fff;
    color: #83FFB3;
}

.tab {
    display: inline-block;
    color: black;
    padding: 20px;
    min-width: 800px;
    border-radius: 10px;
    min-height: 400px;

    background-color: #fff;
}

.tabs-details {
    width: 100%;
}
</style>
