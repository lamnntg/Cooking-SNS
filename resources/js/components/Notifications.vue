<template>
    <div class="dropdown">
        <button
            id="dropdownMenuNoti"
            data-bs-toggle="dropdown"
            aria-expanded="false"
            style="border: none; background-color: transparent;"
        >
            <i class="fas fa-bell">{{ count }}</i>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuNoti">
            <li v-for="item in notifications" :key="item.id">
                <a class="dropdown-item " href="#"> {{ item.message }} </a>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        notificationsData: [Object, Array],
        userId: {
            type: Number
        }
    },
    mounted() {
        Echo.channel(`App.User.${this.user}`).listen(
            "MessageNotification",
            e => {
                this.count++;
                this.notifications.push({...e, id: this.count} );
            }
        );
    },
    data() {
        return {
            notifications: this.notificationsData ? this.notificationsData : [],
            user: this.userId,
            count: 0
        };
    },
    computed: {},
    methods: {

    }
};
</script>
