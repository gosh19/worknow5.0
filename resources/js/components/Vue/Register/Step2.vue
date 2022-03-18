<script>
export default {
    props:{courses: Object},
    methods:{
        isSelected(key){
            return courses[key].selected;
        }
    },
    methods:{
        toggleSelected(key){
            this.courses[key].selected = !this.courses[key].selected;
        }
    }
}
</script>

<template>
    <div class="grid grid-cols-2 md:grid-cols-4 px-2 justify-center gap-3">
        <div v-for="(course, index) in courses" :key="course">

            <button  class="p-2 w-full h-full hover:bg-blue-300 text-white rounded" 
                    :class="{'bg-green-500': course.selected, 'bg-blue-600': !course.selected}"
                    @click="toggleSelected(index)"
            >

                {{course.nombre}}
            </button>
        </div>
    </div>
</template>