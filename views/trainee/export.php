<div class="pure-g">
    <div class="pure-u-1-1">
        <h1 class='ff-1 text-center'>Exportar personas</h1>
    </div>
    <div class="pure-u-1-1">
        <form class="pure-form pure-form-aligned" action="/trainee/export" method="POST">
            <div class="pure-g">
                
                <div class="pure-u-11-24 m-t-2">
                    <label for="export_format" class='top-label ff-1'>Formato</label>
                    <select id="export_format" name="format">
                        <option value="excel">Excel</option>
                    </select>
                </div>
                
                <div class="pure-u-2-24 m-t-2"></div>
                <div class="pure-u-11-24 m-t-2">
                    <button 
                        type="submit" 
                        class="pure-button pure-button-primary line-button styled-button bg-black-1 text-upper text-green-1 ff-1">
                        Exportar
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>