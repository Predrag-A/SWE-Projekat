<template>
  <div>
    <div v-if="active">
      <component :is="this.tag" v-if="days > 0" :class="inputclass" :style="inputstyle">
        Počinje za {{ twoDigits(days) }} dana
      </component>
      <component :is="this.tag" v-if="days == 0" :class="inputclass" :style="inputstyle">
        Počinje za {{ twoDigits(hours) }}:{{ twoDigits(minutes) }}:{{ twoDigits(seconds) }}  
      </component>
    </div>
    <div v-else>
      <component :is="this.tag" v-if="days == 0" :class="inputclass" :style="inputstyle">
        Završen 
      </component>
    </div>
  </div>
</template>

<script>
export default {
  name: 'countdown',
  computed: {
    usableDate () {
      return Math.trunc(Date.parse(this.date) / 1000)
    },
    seconds () {
      return (this.usableDate - this.now) % 60
    },
    minutes () {
      return Math.trunc((this.usableDate - this.now) / 60) % 60
    },
    hours () {
      return Math.trunc((this.usableDate - this.now) / 60 / 60) % 24
    },
    days () {
      return Math.trunc((this.usableDate - this.now) / 60 / 60 / 24)
    },
    active() {
      if(this.seconds < 0 || this.minutes < 0 || this.hours < 0)
        return false;
      return true;
    }
  },
  data () {
    return {
      now: Math.trunc((new Date()).getTime() / 1000)
    }
  },
  methods: {
    twoDigits (number) {
      if (number < 10) return '0' + number
      else return number
    }
  },
  mounted () {
    window.setInterval(() => {
      this.now = Math.trunc((new Date()).getTime() / 1000)
    }, 1000)
  },
  props: {
    date: {
      type: String,
      required: true,
    },
    tag:{
      type: String,
      required: false,
      default: "span"
    },
    inputclass: {
      type:String,
      required: false,
      default:"blue-grey-text text-lighten-2"
    },
    inputstyle: {
      type:String,
      required: false,
      default: "text-shadow: black 0px 0px 10px"
    }
  }
}
</script>