<script>
export default {
    props:['user'],
    data(props){
        return {

            userData: props.user,
        }
    }
}
</script>

<template>
    <div class="bg-white rounded-xl w-full py-4">
        <div class="pb-4 px-4">
            <h1 class="text-4xl text-blueGray-600 font-bold p-1">Registrate</h1>
            <h1 class="p-1 text-xl text-blueGray-600">y probá <b>gratis</b> los cursos que quieras!</h1>
        </div>
        <div class="px-3 py-2 grid grid-cols-1 md:grid-cols-2">
            <div class="col-span-1 p-3">
                <input class="w-full border-b-2 focus:outline-none border-purple-200 rounded focus:border-coolGray-300" 
                v-model="userData.email"
                type="text" placeholder="E-mail">
            </div>
            <div class="col-span-1 p-3">
                <input class="w-full border-b-2 focus:outline-none border-purple-200 rounded focus:border-coolGray-300" 
                v-model="userData.password" type="password" placeholder="Contraseña">
            </div>
            <div class="col-span-1 p-3">
                <input class="w-full border-b-2 focus:outline-none border-purple-200 rounded focus:border-coolGray-300" 
                v-model="userData.name" type="text" placeholder="Nombre completo">
            </div>
            <div class="col-span-1 p-3">
                <input class="w-full border-b-2 focus:outline-none border-purple-200 rounded focus:border-coolGray-300" 
                v-model="userData.phone" type="text"  placeholder="Teléfono">
            </div>    
        </div>
    </div>
</template>