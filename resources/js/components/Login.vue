<template>
    <div>
        <form class="m-4" @submit.prevent="login" method="post">
            <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary mt-2">Login</button>
        </form>
    </div>
</template>
