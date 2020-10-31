<div class="pure-g">
    <div class="pure-u-1-1">
        <h1 class='ff-1 text-center'>Alta de persona</h1>
    </div>
    <div class="pure-u-1-1">
        <form class="pure-form pure-form-aligned" action="/trainee/new" method="POST">
            <div class="pure-g">
                <div class="pure-u-11-24 m-t-2">
                    <input 
                        type="text" 
                        name='fullname'
                        title="Indique nombre y apellido"
                        required
                        value="<?= $trainee ? $trainee['fullname'] : '' ?>"
                        class="line-input styled-input ff-1" 
                        placeholder="Nombre y apellido"/>
                </div>
                <div class="pure-u-2-24 m-t-2"></div>
                <div class="pure-u-11-24 m-t-2">
                    <input 
                        type="text"
                        name="dni"
                        title="Al menos 8 números sin puntos, comas o espacios"
                        pattern="\d{8,}"
                        required
                        value="<?= $trainee ? $trainee['dni'] : '' ?>"
                        class="line-input styled-input ff-1" 
                        placeholder="DNI"/>
                </div>
                <div class="pure-u-11-24 m-t-2">
                    <input 
                        type="text"
                        name="phone"
                        pattern="[0-9\s\-]+"
                        value="<?= $trainee ? $trainee['phone'] : '' ?>"
                        class="line-input styled-input ff-1" 
                        placeholder="Teléfono/Celular"/>
                </div>
                <div class="pure-u-2-24 m-t-2"></div>
                <div class="pure-u-11-24 m-t-2">
                    <input 
                        type="text"
                        name="address"
                        title="Ingrese la dirección"
                        required
                        value="<?= $trainee ? $trainee['address'] : '' ?>"
                        class="line-input styled-input ff-1" 
                        placeholder="Dirección"/>
                </div>
                <div class="pure-u-11-24 m-t-2">
                    <button 
                        type="submit" 
                        class="pure-button pure-button-primary line-button styled-button bg-black-1 text-upper text-green-1 ff-1">
                        Registrar Nueva Persona
                    </button>
                </div>
                <div class="pure-u-13-24"></div>
            </div>
        </form>
    </div>
</div>