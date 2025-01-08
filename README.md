# Lunar Wine Commerce

A Lunar Wine Commerce egy Laravel 11 alapú e-kereskedelmi alkalmazás, amely a **Lunar** csomagot és a **TALL stack** technológiákat (Tailwind CSS, Alpine.js, Laravel, Livewire) használja. Ez a projekt egy borszaküzlet kialakítását mutatja be.

---

## Funkciók

### Alapvető funkcionalitás
- **Termékkatalógus**: 
  - Több termék feltöltése és kezelése.
  - Termékek kategóriákba és gyűjteményekbe rendezése.

- **Vásárlói kosár**:
  - Termékek dinamikus hozzáadása/eltávolítása Livewire segítségével.
  - Automatikus árkalkuláció.

- **Rendeléskezelés**:
  - Zökkenőmentes rendeléslétrehozás a kosár tartalmából.
  - Automatikus frissítések a `lunar_orders` és `lunar_order_lines` táblákban.

### Admin funkciók
- **Beszállítók kezelése**:
  - A lunar csomag admin felületét kiegészítettem egy beszállítók listája komponenssel, amit Filament-el hoztam létre, itt minden
    termékhez tartozik egy fiktív beszállító.
  - A komponens figyeli az árukészletet és figyelmeztet ha egy termék mennyisége 20 darab alá esik.


### Technológiai háttér
- **Laravel 11**: Backend keretrendszer.
- **Lunar**: Laravel e-kereskedelmi csomag.
- **Livewire**: Dinamikus, reaktív komponensek.
- **Tailwind CSS**: A Flowbite-al kísérleteztem ebben a projektben.
- **Alpine.js**: Kisebb logikai műveletek, mint pl modal vagy készlet figyelés és figyelmeztetés túllépés esetén
- **Filament**: Az oldal admin felületén létrehozott "Suppliers" komponens.
- **SQLite**: Adatbázis.

---

## Telepítés

### Előfeltételek
- PHP 8.2 vagy újabb
- Composer
- Node.js és npm
- SQLite vagy kompatibilis adatbázis

### Lépések
1. Klónozd a repót:
   ```bash
   git clone https://github.com/KalapacsJoco/lunar-wine-commerce.git

   ```

2. Lépj be a projekt könyvtárába:
   ```bash
   cd lunar-wine-commerce
   ```

3. Telepítsd a függőségeket:
   ```bash
   composer install
   npm install
   ```

4. Állítsd be a környezeti fájlt:
   ```bash
   cp .env.example .env
   ```
   Konfiguráld a `.env` fájlt az adatbázis és egyéb beállítások alapján.

5. Futtasd a migrációkat és a seedereket:
   ```bash
   php artisan migrate --seed
   ```
6. Építsd fel a front-end fájlokat:
   ```bash
   npm run dev
   ```
7. Indítsd el a fejlesztői szervert:
   ```bash
   php artisan serve
   ```
---

## Jövőbeli fejlesztések
- Carousel a termékek kényelmesebb tallózásához.
- Fejlettebb jelentések a rendelésekhez és a készlethez.
- Fizetési módszerek, kedvezmények beépítése.
- Többnyelvű támogatás a globális elérhetőséghez.
- Még 1001 ötletem volt és lesz hogy mit lehetne csinálni még vele, de ezek a fontosabbak :D

---

## Jelenlegi megoldatlan problémák
- A keresősáv jól működik és a termékek kattintásra megjelennek egy modalban, de a modal gombjai jelenleg még nem reagálnak megfelelően.

Összességében egy izgalmas, új technológiai kihívás és tanulási lehetőség volt ez a projekt (a maga hullámvölgyeivel és hullámhegyeivel együtt :)) ), mely által mélyebb rálátásom nyílt a Lunar, Tall stack és Filament működésére.

---

## Rövid bemutató videó

https://www.youtube.com/watch?v=eyxsg1awYlo




