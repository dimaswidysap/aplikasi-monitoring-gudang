function createSideBar(conTarget) {
  const container = document.createElement("section");
  const header = document.createElement("header");
  const ul = document.createElement("ul");

  conTarget.appendChild(container);
  container.appendChild(header);
  container.appendChild(ul);

  header.textContent = "TokoKu";

  Object.assign(header.style, {
    fontWeight: "bold",
    margin: "0 0 3rem 0",
    fontSize: "2em",
    padding: "0 0.4rem",
  });

  Object.assign(container.style, {
    height: "95%",
    width: "90%",
    backgroundColor: "var(--primary-color)",
    // backgroundColor: "green",
    padding: "0 1rem 0 1rem",
    borderRadius: "10px",
    boxShadow:
      "rgba(0, 0, 0, 0.12) 0px 3px 8px, rgba(0, 0, 0, 0.24) 0px 3px 5px",
  });

  Object.assign(ul.style, {
    width: "100%",
    display: "flex",
    flexDirection: "column",
    // gap: "1rem",
  });

  for (let i = 0; i < 4; i++) {
    const li = document.createElement("li");
    const a = document.createElement("a");

    ul.appendChild(li);
    li.appendChild(a);

    Object.assign(li.style, {
      listStyle: "none",
      borderRadius: "5px",
    });

    Object.assign(a.style, {
      display: "inline-flex",
      padding: "1rem 0.4rem",
      width: "100%",
      fontWeight: "bold",
    });

    switch (true) {
      case i === 0:
        a.textContent = "Home";
        a.setAttribute("href", "index.php");
        if (lokasi === "home") {
          console.log("ini dihome");
          li.classList.add("halaman-active");
        }
        break;
      case i === 1:
        a.textContent = "Tambah Data";
        a.setAttribute("href", "tambah.php");
        if (lokasi === "tambah") {
          console.log("ini ditambah");
          li.classList.add("halaman-active");
        }
        break;
      case i === 2:
        a.textContent = "Hapus Data";
        a.setAttribute("href", "hapus.php");
        if (lokasi === "hapus") {
          console.log("ini dihapus");
          li.classList.add("halaman-active");
        }
        break;
      case i === 3:
        a.textContent = "Update data";
        a.setAttribute("href", "update.php");
        if (lokasi === "update") {
          console.log("ini diupdate");
          li.classList.add("halaman-active");
        }
        break;
    }
  }
}

export { createSideBar };
