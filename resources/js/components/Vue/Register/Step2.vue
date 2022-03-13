<script>
export default {
    props:{courses: Object},
}
</script>

<template>
    <div class="grid grid-cols-4">

        <div class="col-span-1 p-2 bg-blue-600 text-white"
         v-for="course in courses" :key="course">

            {{course.nombre}}
        </div>
    </div>
</template>