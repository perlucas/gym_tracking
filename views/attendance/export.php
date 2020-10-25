<div class="pure-g">
    <div class="pure-u-1-1">
        <form class="pure-form pure-form-aligned" action="/attendance/export" method="POST">
            <div class="pure-g">

                <div class="pure-u-11-24 m-t-2">
                    <input 
                        type="datetime" 
                        id="multi-first-name" 
                        class="line-input styled-input ff-1" 
                        placeholder="Fecha inicial"/>
                </div>
                <div class="pure-u-2-24 m-t-2"></div>
                <div class="pure-u-11-24 m-t-2">
                    <input 
                        type="datetime" 
                        id="multi-first-name" 
                        class="line-input styled-input ff-1" 
                        placeholder="Fecha final"/>
                </div>
                
                <div class="pure-u-11-24 m-t-2">
                    <label for="export_format">Formato</label>
                    <select 
                        id="export_format"
                        class=""
                    >
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