function createSideBar(conTarget) {
  const container = document.createElement("section");
  const ul = document.createElement("ul");

  conTarget.appendChild(container);
  container.appendChild(ul);

  Object.assign(container.style, {
    height: "100%",
    width: "100%",
    backgroundColor: "var(--primary-color)",
    padding: "1rem 0.4rem",
  });

  Object.assign(ul.style, {
    width: "100%",
    display: "flex",
    flexDirection: "column",
    gap: "1rem",
  });

  for (let i = 0; i < 4; i++) {
    const li = document.createElement("li");
    const a = document.createElement("a");

    ul.appendChild(li);
    li.appendChild(a);

    a.textContent = "tes";

    switch (true) {
      case i === 0:
        a.textContent = "Home";
        a.setAttribute("href", "index.php");
        break;
      case i === 1:
        a.textContent = "Tambah Data";
        a.setAttribute("href", "tambah.php");
        break;
      case i === 2:
        a.textContent = "Hapus Data";
        a.setAttribute("href", "hapus.php");
        break;
      case i === 3:
        a.textContent = "Update data";
        a.setAttribute("href", "update.php");
        break;
    }
  }
}

export { createSideBar };
