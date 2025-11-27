<div style="height: 50px;"></div>

    </main> </div> <style>
    .rodape-pagina {
        margin-top: auto;
        padding-top: 20px;
        border-top: 1px solid #333; 
        color: #666; 
        font-size: 0.85rem;
        text-align: center;
        width: 100%;
    }
</style>

<script>
    const botoesDeletar = document.querySelectorAll('.btn-deletar');
    botoesDeletar.forEach(btn => {
        btn.addEventListener('click', (e) => {
            if(!confirm('Tem certeza que deseja excluir este item?')) {
                e.preventDefault();
            }
        });
    });
    
</script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>