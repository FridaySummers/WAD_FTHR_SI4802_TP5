# Tutorial Singkat Pengerjaan TP Menggunakan Branch

Semua peserta wajib mengerjakan Tugas Pendahuluan di **branch masing-masing**, bukan di branch `main`.

---

## Format Nama Branch
```
namapendek
```
Contoh:
```
sahal
```

---

## Melalui Terminal (Git / VS Code)

### 1. Update branch `main`
```bash
git checkout main
git pull origin main
```

### 2. Buat branch baru
```bash
git checkout -b namapendek
```
Contoh:
```bash
git checkout -b sahal
```


### 3. Commit & Push
```bash
git add .
git commit -m "DONE BANGGGGG"
git push -u origin namapendek
```

---

### 4. Buat Pull Request
1. Buka repository di GitHub.
2. Klik tombol **Compare & pull request**.
3. Kirim Pull Request ke branch `main`.

---

## Melalui GitHub Desktop

### 1. Buat Branch
1. Buka GitHub Desktop  
2. Klik **Current Branch** → **New Branch**  
3. Isi nama branch:
   ```
   namapendek
   ```
4. Klik **Create Branch**

---


### 3. Commit & Push
1. Isi commit message:
   ```
   DONE BANGGG (contoh)
   ```
2. Klik **Commit**
3. Klik **Push origin**

---

### 4. Buat Pull Request
1. Klik tombol **Create Pull Request**
2. Isi judul:
   ```
   TP5 - NAMAPENDEK
   ```
3. Kirim ke branch `main`

---

## Checklist Sebelum Submit

✅ Tidak mengerjakan di branch `main`  
✅ Nama branch sesuai format  
✅ Nama folder sesuai format  
✅ Sudah commit  
✅ Sudah push  
✅ Sudah membuat Pull Request  

---

KALO BINGUNG, TANYA (pelis) :D
