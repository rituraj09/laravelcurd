<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card"> 
                    <div class="card-header">
                        Directory
                    </div>
                    <div class="card-body">
                        <div class="form-group"> 
                            <label for="name" >Name</label>
                            <input type="text" 
                            id="name"
                            placeholder="Enter your name"
                            class="form-control"
                            >

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Directory",
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>