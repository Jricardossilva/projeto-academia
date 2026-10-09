<!DOCTYPE html>
<html lang="pt-BR" data-theme="light">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="description"
        content="Página da equipe responsável pelo desenvolvimento do projeto."
    >

    <title>Equipe</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <!-- CSS da página Equipe -->
    <link
        rel="stylesheet"
        href="{{ asset('css/Login/Forms/Equipe Style/equipe.css') }}"
    >
</head>


<body>

    <main>

        <section class="py-5 equipe-page">

            <div class="container">

                <!-- =====================================================
                     CABEÇALHO
                     ===================================================== -->

                <div class="text-center mb-5">

                    <span
                        class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 mb-3"
                    >
                        Nossa Equipe
                    </span>

                    <h2 class="fw-bold mb-2">
                        Desenvolvimento em Equipe
                    </h2>

                    <p class="text-muted mb-0">
                        Conheça o professor e os desenvolvedores
                        responsáveis pelo desenvolvimento deste projeto.
                    </p>

                </div>


                <!-- =====================================================
                     PROFESSOR
                     ===================================================== -->

                <div class="row justify-content-center mb-5">

                    <div class="col-lg-8 col-xl-7">

                        <div class="card border-0 shadow-sm">

                            <div class="card-body p-4 p-lg-5">

                                <div class="row align-items-center g-4">

                                    <!-- FOTO DO PROFESSOR -->

                                    <div class="col-md-4 text-center">

                                        <img
                                            src="{{ asset('images/professor.jpg') }}"
                                            alt="Foto do professor"
                                            class="rounded-circle img-fluid"
                                            style="
                                                width: 150px;
                                                height: 150px;
                                                object-fit: cover;
                                            "
                                        >

                                    </div>


                                    <!-- INFORMAÇÕES DO PROFESSOR -->

                                    <div
                                        class="
                                            col-md-8
                                            text-center
                                            text-md-start
                                        "
                                    >

                                        <span class="badge bg-primary mb-2">
                                            Professor
                                        </span>

                                        <h3 class="fw-bold mb-2">
                                            Nome do Professor
                                        </h3>

                                        <p class="text-muted mb-3">
                                            35 anos
                                        </p>

                                        <a
                                            href="https://www.linkedin.com/"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="btn btn-outline-primary"
                                        >
                                            <i class="bi bi-linkedin me-1"></i>

                                            LinkedIn
                                        </a>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- =====================================================
                     DESENVOLVEDORES
                     ===================================================== -->

                <div class="row g-4">


                    <!-- =================================================
                         DESENVOLVEDOR 1
                         ================================================= -->

                    <div class="col-md-6 col-xl-3">

                        <div
                            class="
                                card
                                h-100
                                border-0
                                shadow-sm
                                text-center
                            "
                        >

                            <div class="card-body p-4">

                                <img
                                    src="{{ asset('images/desenvolvedor-1.jpg') }}"
                                    alt="Foto do desenvolvedor"
                                    class="rounded-circle mb-3"
                                    style="
                                        width: 110px;
                                        height: 110px;
                                        object-fit: cover;
                                    "
                                >

                                <h5 class="fw-bold mb-1">
                                    Nome do Desenvolvedor
                                </h5>

                                <p class="text-muted small mb-3">
                                    20 anos
                                </p>

                                <a
                                    href="https://www.linkedin.com/"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="btn btn-sm btn-outline-primary"
                                >
                                    <i class="bi bi-linkedin me-1"></i>

                                    LinkedIn
                                </a>

                            </div>

                        </div>

                    </div>


                    <!-- =================================================
                         DESENVOLVEDOR 2
                         ================================================= -->

                    <div class="col-md-6 col-xl-3">

                        <div
                            class="
                                card
                                h-100
                                border-0
                                shadow-sm
                                text-center
                            "
                        >

                            <div class="card-body p-4">

                                <img
                                    src="{{ asset('images/desenvolvedor-2.jpg') }}"
                                    alt="Foto do desenvolvedor"
                                    class="rounded-circle mb-3"
                                    style="
                                        width: 110px;
                                        height: 110px;
                                        object-fit: cover;
                                    "
                                >

                                <h5 class="fw-bold mb-1">
                                    Nome do Desenvolvedor
                                </h5>

                                <p class="text-muted small mb-3">
                                    20 anos
                                </p>

                                <a
                                    href="https://www.linkedin.com/"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="btn btn-sm btn-outline-primary"
                                >
                                    <i class="bi bi-linkedin me-1"></i>

                                    LinkedIn
                                </a>

                            </div>

                        </div>

                    </div>


                    <!-- =================================================
                         DESENVOLVEDOR 3
                         ================================================= -->

                    <div class="col-md-6 col-xl-3">

                        <div
                            class="
                                card
                                h-100
                                border-0
                                shadow-sm
                                text-center
                            "
                        >

                            <div class="card-body p-4">

                                <img
                                    src="{{ asset('images/desenvolvedor-3.jpg') }}"
                                    alt="Foto do desenvolvedor"
                                    class="rounded-circle mb-3"
                                    style="
                                        width: 110px;
                                        height: 110px;
                                        object-fit: cover;
                                    "
                                >

                                <h5 class="fw-bold mb-1">
                                    Nome do Desenvolvedor
                                </h5>

                                <p class="text-muted small mb-3">
                                    20 anos
                                </p>

                                <a
                                    href="https://www.linkedin.com/"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="btn btn-sm btn-outline-primary"
                                >
                                    <i class="bi bi-linkedin me-1"></i>

                                    LinkedIn
                                </a>

                            </div>

                        </div>

                    </div>


                    <!-- =================================================
                         DESENVOLVEDOR 4
                         ================================================= -->

                    <div class="col-md-6 col-xl-3">

                        <div
                            class="
                                card
                                h-100
                                border-0
                                shadow-sm
                                text-center
                            "
                        >

                            <div class="card-body p-4">

                                <img
                                    src="{{ asset('images/desenvolvedor-4.jpg') }}"
                                    alt="Foto do desenvolvedor"
                                    class="rounded-circle mb-3"
                                    style="
                                        width: 110px;
                                        height: 110px;
                                        object-fit: cover;
                                    "
                                >

                                <h5 class="fw-bold mb-1">
                                    Nome do Desenvolvedor
                                </h5>

                                <p class="text-muted small mb-3">
                                    20 anos
                                </p>

                                <a
                                    href="https://www.linkedin.com/"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="btn btn-sm btn-outline-primary"
                                >
                                    <i class="bi bi-linkedin me-1"></i>

                                    LinkedIn
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </main>


    <!-- Bootstrap JS -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    ></script>

</body>

</html>